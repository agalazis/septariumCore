<?php
namespace core;
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
        $this->renderHtml();
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

    /*
     *
     * Renders the basic html document structure
     * @access public
     * @return void
     */
    function renderHtml(){
        $this->loadConfig();
        $this->head();
        $this->body();
        $this->footer();
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