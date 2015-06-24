<?php


namespace core;
/**
 * The Controller abstract class provides basic functionality
 * for content negotiation which will be used by every controller
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

abstract class Controller {

        protected $acceptTypes;
    /**
     *Constructor Loads configuration
     * and runs process request function
     * of the current extention
     * @return void
     */
    function __construct($model){
            $this->loadConfig();
            $this->contentNegotiation();
            $this->processRequest($model);
        }
        /**
         * determines whether a contnent type is in the accept headers
         * @access protected
         * @return void
         */
        private function checkContentType($cType){
            return (stristr($_SERVER["HTTP_ACCEPT"], $cType));
        }
        /**
         * determines the right content to server based on accept header
         * @access protected
         * @return void
         */
        protected function contentNegotiation(){
           //make sure that this runs only once as it wil always yeld the same result
           if (!defined('CONTENT_TYPE')) {
               for ($i = 0; $i < count($this->acceptTypes); $i++) {
                   if ($this->checkContentType($this->acceptTypes[$i])) {
                       define('CONTENT_TYPE', $this->acceptTypes[$i]);
                       return;
                   }
               }
               define('CONTENT_TYPE', "text/html");
           }
        }
        /**
         * loads the configuration: the different accept types
         * @access protected
         * @retrun void
         */
        protected function loadConfig(){
            $this->acceptTypes = parse_ini_file("config.ini")["contentTypes"];
        }
        abstract protected function processRequest($model);
}