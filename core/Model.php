<?php
/**
 * The Model abstract class provides basic functionality
 * for XML JSON serialization of the models
 *
 * This class provides static functions used to analyse
 * the path/current route of the application and to dispatch requests
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
 * @package core
 * @author     Andreas Galazis <andreas@linx.ninja>
 * @copyright  2015 Andreas Galazis
 * @license    http://opensource.org/licenses/MIT  MIT License
 * @abstract
 */

namespace core;
use core\Interfaces\JSONSerializable;
use core\Interfaces\XMLSerializable;
abstract class Model implements JSONSerializable, XMLSerializable{
    /*
    *
    * A method that provides convertion to JSON
    * @access public
     * @return string
    */
    public function toJSON(){
        return json_encode($this);
    }
    /*
    *
    * A method that provides convertion toXML
    * @return string
    * @access pubic
    */
    public function toXML(){
        return  xmlrpc_encode($this);
    }
}