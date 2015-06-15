<?php
namespace libs\csv;
class CSVReader extends CSVHandler {
    /**
     * array that will be populated with the headers of the csv file
     * @var array
     * @access private
     */
    private $headers = array();
    /**
     * if the first row is the header line
     * @var bool
     * @access private
     */
    private $firstRowHeaderLine=true;
    /**
     * if header alreadySet
     * @var bool
     * @access private
     */
    private $headerSet=false;
    private function keyValueFormat($row){
        return $this->headers ? array_combine($this->headers, $row) : $row;
    }
    /**
     * constructor: sets the path of the csv
     */
    public function __construct($path, $mode = 'r+', $headersInFirstRow = true)
    {
        parent::__construct($path, $mode);
        $this->headersInFirstRow = $headersInFirstRow;
        $this->line = 0;
    }
    /**
     * @return array
     * @access public
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    protected function setHeader()
    {
        if ($this->headerSet||!$this->firstRowHeaderLine) {
            return;
        }
        $this->fileHandle->rewind();
        $this->headerSet= true;
        $this->headers = $this->getNextRow();

    }
    /**
     * Returns array of string columns or false if EOF reached
     * @return array|bool
     */
    public function getNextRow()
    {
        $this->setHeader();
        if ($this->fileHandle->eof()) {
            return false;
        }
        $row = $this->fileHandle->fgetcsv($this->delimiter, $this->enclosure);
        $isEmpty = $this->rowIsEmpty($row);
        if ($row !== false && $row != null && $isEmpty === false) {
            $this->line++;
            return $this->keyValueFormat($row);
        } elseif ($isEmpty) {

            // try the next row
            return $this->getNextRow();
        } else {
            return false;
        }
        return $row;
    }
    /**
     * Returns array of rows string arrays
     * @return array
     */
    public function getAllRows()
    {
        $data = array();
        //$data[]=
        //var_dump($data);
       while ($row = $this->getNextRow()) {
            $data[] =$row;
        }
        return $data;
    }
    /**
     * Returns line number(0 based index)
     * @return int
     */
    public function getLineNumber()
    {
        return $this->fileHandle->key();
    }
    /**
     * @param $row
     * @return bool
     */
    private function rowIsEmpty($row)
    {
        $empty = ($row === array(null));
        $emptyWithDelimiters = (array_filter($row) === array());
        return $empty ||$emptyWithDelimiters;
    }
}