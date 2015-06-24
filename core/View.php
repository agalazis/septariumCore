<?php
namespace core;
use app\interfaces\Configurable;
use core\Exception\CoreException;

/**
 * RouteHelper class to provide route analysis support
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
abstract class View{
    private static $renderTypes=array(
        "text/html"=>"renderHtml",
        "application/xhtml+xml"=>"renderHtml",
        "text/xml"=>"renderXML",
        "text/xml"=>"renderXML",
        "application/json"=>"renderJSON",
    );
    /*
     * @var array $config associative array used for loading configuration variables
     * @access protected
     */
    protected $config;
    /*
     * @var array $tagTemplate associative array of tag template strings mainly ued fot js/css asset tags
     * @access protected
     */
    protected $tagTemplate=array('css'=>'<link rel="stylesheet" media="all" href="|" />',
        'js'=>'<script src="|"></script>');
    /*
     * @var Object $model the model associated with the view -dependency injection
     * @access protected
     */
    protected $model;
    /*Constructor renders HTML for the given model
     * @param object $model
     * @access public
     * @return void
     */
    function __construct($model){
        $this->model = $model;
        $this->render();


    }
    /*retruns a tag for for linking an asset on page
    * @param object $model
    * @access public
    * @return void
    */
    protected  function getAssetTag($assetLink,$template){
        $parts=explode("|",$this->tagTemplate[$template]);
        return $parts[0].$assetLink.$parts[1];

    }
    private function render(){
        $this->loadConfig();
        if (defined ('CONTENT_TYPE')) {
            $contentType =constant('CONTENT_TYPE');
        }else{
            $contentType="text/html";
        }
        $renderFunction=self::$renderTypes[$contentType];
        if ($renderFunction&&method_exists ($this,$renderFunction)) {
            $this->$renderFunction($contentType);
        }else{
            //falls back to HTML
            $this->renderHtml();
        }
    }
    /*
     *
     * Renders the basic html document structure
     * @access private
     * @return void
     */
    private function renderHtml(){
        header("Content-Type: text/html; charset=utf-8");
        $this->head();
        $this->body();
        $this->footer();
    }
    /*
     *
     * Just render the JSON for the model
     * @access private
     * @return void
     */
    private function renderJSON($contentType="application/json"){
        header("Content-Type: ".trim($contentType)."; charset=utf-8");
        $json=$this->model->toJSON();
        if ( $json) {
            echo $json;
        }else{
            throw new CoreException("406","Content type not acceptable for this endpoint");
        }
    }
    /*
     *
     * Just render the XML for the model
     * @access private
     * @return void
     */
    private function renderXML($contentType="application/xml"){
        header("Content-Type: ".trim($contentType)."; charset=utf-8");
        $xml=$this->model->toXML();
        if (is_string($xml)) {
            echo $xml;
        }else {
            throw new CoreException("406","Content type not acceptable for this endpoint");
        }
    }
    /*
     *
     * Abstract method that should provide the implementation
     * of configuration loading
     * @abstract
     * @access protected
     */
    abstract protected function loadConfig();
    /*
    *
    * An abstract method that should provide head rendering
    * @abstract
    * @access protected
    */
    abstract protected function head();
    /*
    *
    * An abstract method that should provide the title
    * @abstract
    * @access protected
    */
    abstract protected function title();
    /*
    *
    * An abstract method that should provide body rendering
    * @abstract
    * @access protected
    */
    abstract protected function body();


}?>