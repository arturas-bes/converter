<?php
namespace Cart\Utils;

use Cart\Utils\Helpers\Utilities;
use PHPUnit\Util\Exception;
use function PHPUnit\Framework\throwException;

class FileReader implements FileReaderInterface
{
    private $fileContents;

    public function read($file)
    {
       $content = $this->getFileLines($file);
       $this->formatItems($content);

       return $this->fileContents;
    }

    private function getFileLines($file)
    {
        if (!$this->fileContents) {
            $file = fopen($file, "r");
            if (!$file) {
                return false;
            }

            while (($line = fgets($file)) !== false) {
                $this->setFileLines($line);

            }
            fclose($file);
        }

        return $this->fileContents;

    }

    private function setFileLines($content)
    {
        return $this->fileContents[] = $content;
    }

    private function formatItems($line)
    {
        $result = null;
        foreach ($line as $item) {

           $result[] = $this->splitToArray($item);
        }
        if(!$result) {
            throw new Exception("Could not format items");
        }

        $this->fileContents = $result;
    }

    private function splitToArray($item)
    {
        $utils = new Utilities();

        return $utils->multiExplode(array(",","|",";"),$item);
    }

}