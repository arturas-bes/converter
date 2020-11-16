<?php
namespace Cart\Utils;

use Cart\Utils\Helpers\Utilities;
use PHPUnit\Util\Exception;
use function PHPUnit\Framework\throwException;

class FileReader implements FileReaderInterface
{
    /**
     * @var
     */
    private $fileContents;

    /**
     * @var mixed|null
     */
    private $file;

    public function __construct($file = null)
    {
        $this->file = $file;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function read($key)
    {
       $line = $this->getLine($key);
       $this->formatItem($line);

       return $this->fileContents;
    }

    /**
     * @param $key
     * @return false|mixed
     */
    private function getLine($key)
    {
        $lines = file($this->file, FILE_IGNORE_NEW_LINES);
        if (!$lines) {

            return false;
        }

        return $lines[$key];
    }

    /**
     * @return false|int
     */
    public function getLineCount()
    {
        $file = file($this->file);
        if (!is_countable($file)) {
            return false;
        }

        return count($file);
    }

    /**
     * @param $file
     * @return false
     */
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

    /**
     * @param $content
     * @return mixed
     */
    private function setFileLines($content)
    {
        return $this->fileContents[] = $content;
    }

    /**
     * @param $line
     */
    private function formatItem($line)
    {
        $result = $this->splitToArray($line);

        if(!$result) {
            throw new Exception("Could not format items");
        }

        $this->fileContents = $result;
    }

    /**
     * @param $item
     * @return false|string[]
     */
    private function splitToArray($item)
    {
        $utils = new Utilities();

        return $utils->multiExplode(array(",","|",";"),$item);
    }

}