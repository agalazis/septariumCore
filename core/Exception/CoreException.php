<?php
namespace core\Exception;
use core;
/**
 * The CoreException  that will be thrown for predictable failures
 * in-existent pages e.t.c
 *
 * Using the implemented  functions my minimal framework
 * can provide user friendly replies in case of an exception
 *
 *Copyright (c) 2015 Andreas Galazis
 *
 *Permission is hereby granted, free of charge, to any person obtaining a copy
 *of this software and associated documentation files (the "Software"), to deal
 *in the Software without restriction, including without limitation the rights
 *to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *copies of the Software, and to permit persons to whom the Software is
 *furnished to do so, subject to the following conditions:
 *
 *The above copyright notice and this permission notice shall be included in
 *all copies or substantial portions of the Software.
 *
 *THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 *THE SOFTWARE.
 * @package    core\Exception
 * @author     Andreas Galazis <andreas@linx.ninja>
 * @copyright  2015 Andreas Galazis
 * @license    http://opensource.org/licenses/MIT  MIT License
 * @package core
 */
class CoreException extends \Exception implements ICoreException
{

    protected $message = 'Unknown exception';     // Exception message
    private   $string;                            // Unknown
    protected $code;                                //error code
    protected $file;                              // Source filename of exception
    protected $line;                              // Source line of exception
    private   $trace;                             // Unknown
    /**
     * Constructor
     * @access public
     * @param string $message the error message of the error
     * @param int $code the error code of the error
     * @return void
     */
    public function __construct( $code = null,$message = "")
    {
        if (!$code) {
            throw new $this(0,'Unknown '. get_class($this));
        }
        $this->message=$message;
        $this->code=$code;
    }
    /**
     * To string function
     * @access public
     * @return string
     */
    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
        . "{$this->getTraceAsString()}";
    }
    /**
     * Returns the code of the error
     * @access public
     * @return string
     */
    public function getCodeNumber(){
        return $this->code;
    }
    /**
     * Returns the message of the error
     * @access public
     * @return string
     */
    public function getMassage(){
        return $this->message;
    }
}