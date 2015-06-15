<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 12/06/15
 * Time: 11:04
 */

namespace libs\csv;


abstract class CSVHandler {
    protected $fileHandle;
    protected $delimiter = ',';
    protected $enclosure = '"';
    public function __construct($path, $mode = 'r+')
    {
        if ( ! file_exists($path)) {
            touch($path);
        }
        $this->fileHandle = new \SplFileObject($path, $mode);
        $this->fileHandle->setFlags(\SplFileObject::DROP_NEW_LINE);
    }
    public function __destruct()
    {
        $this->fileHandle = null;
    }
    public function setEnclosure($enclosure){
        $this->enclosure = $enclosure;
    }
    public function setDelimiter($delimiter)
    {
        $this->delimiter = $delimiter;
    }
}