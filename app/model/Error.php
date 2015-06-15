<?php
namespace app\model;
use app;
/**
 * Error model Class
 *
 * Responsible for keeping all the error data for core(predictable) exceptions
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
 *
 * @author     Andreas Galazis <andreas@linx.ninja>
 * @copyright  2015 Andreas Galazis
 * @license    http://opensource.org/licenses/MIT  MIT License
 *
 */
class Error {
    /**
     *
     * @var string $message the message for he error
     */
    private $message = "";
    /**
     *
     * @var string $errorCode the errorCode for he error
     */
    private $errorCode = "";
    /**
     *
     * @var string $details the details for he error
     *
     */
    private $details = "";
    /**
     * Error message getter: returns the message for the error
     * @access public
     * @return string
     */
    public function getMessage(){
        return $this->message;
    }
    /**
     * Message setter :Sets the message for the error
     * @access public
     * @param  string $msg   the message to set for the error
     */
    public function setMessage($msg){
        $this->message=$msg;
    }
    /**
     * Error code getter: returns the error code for the error
     * @access public
     * @return string
     */
    public function getErrorCode(){
        return $this->errorCode ;
    }
    /**
     * errorCode setter :Sets the error code for the error
     * @access public
     * @param  string $errCode   the error code to set for the error
     */
    public function setErrorCode($errCode){
        $this->errorCode=$errCode;

    }
    /**
     * Details getter: returns the details for the error
     * @access public
     * @return string
     */
    public function getDetails(){
        return $this->details;
    }
    /**
     * details setter :Sets the details for the error
     * @access public
     * @param  string $details   the details to set for the error
     */
    public function setDetails($details){
        $this->details=$details;

    }

}
?>