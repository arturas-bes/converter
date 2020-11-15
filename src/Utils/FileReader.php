<?php
namespace Cart\Utils;

use Cart\Utils\Helpers\Utilities;
use PHPUnit\Util\Exception;
use function PHPUnit\Framework\throwException;

class FileReader implements FileReaderInterface
{
    private $fileContents;

    private $file;

    public function __construct($file = null)
    {
        $this->file = $file;
    }

    public function read($key)
    {
       $line = $this->getLine($key);
       $this->formatItem($line);

       return $this->fileContents;
    }

    private function getLine($key)
    {
        $lines = file($this->file);
        if (!$lines) {

            return false;
        }

        return $lines[$key];
    }

    public function getLineCount()
    {
        $file = file($this->file);
        if (!is_countable($file)) {
            return false;
        }

        return count($file);
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

    private function formatItem($line)
    {
        $result = null;
        $result = $this->splitToArray($line);

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