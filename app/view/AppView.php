<?php
namespace app\view;
use core;
/**
 * View Class
 *
 * This is where the application views(specific to this application) inherit from
 * It has functionalities for loading assets to the head  Or at the end of the body appropriately,
 * footer and header implementation Also requires implementation of the content method by its ancestors
 *
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
 * @abstract
 */
abstract class AppView extends core\View
{



    /**
     * Renders the body of the application
     * @override
     * @access protected
     */

    /**
     * Builds the header of the html document
     *appends css assets
     * @override
     * @access protected
     * @return string
     */
    protected function head(){
        $head="";
        if (isset($this->config["assetPath"])&&isset($this->config["css"])){
            for ($i = 0; $i < count($this->config["css"]); $i++){
                $head.=$this->getAssetTag($this->config["assetPath"]."css/".$this->config["css"][$i],"css");
            }

        }
        if (isset($this->config["cdnCss"])) {
            for ($i = 0; $i < count($this->config["cdnCss"]); $i++) {
                $head .=$this->getAssetTag( $this->config["cdnCss"][$i], "css");
            }
        }
        global $assetTags,$smarty;
        $smarty->assign("HAEDASSETTAGS",$head);
        $this->title();   
        $smarty->display("app/view/template/Header.tpl");  
    }
    /**
     * loads configuration from ini file
     * @override
     * @access protected
     */
    protected function loadConfig(){
        $this->config = parse_ini_file("config.ini");
    }

    /**
     * returns the footer
     * @override
     * @access private
     */
    protected function footer(){
        global $copy, $smarty;
        $smarty->assign("COPY","&copy; Andreas Galazis 2015");
        $smarty->display("app/view/template/Footer.tpl");
    }
    protected function getJSTags(){
        $assetTags="";
        if (isset($this->config["cdnJs"])) {
            for ($i = 0; $i < count($this->config["cdnJs"]); $i++) {
                $assetTags.=$this->getAssetTag( $this->config["cdnJs"][$i], "js");
            }
        }
        if (isset($this->config["assetPath"])&&isset($this->config["js"])) {
            for ($i = 0; $i < count($this->config["js"]); $i++) {
                $assetTags.=$this->getAssetTag($this->config["assetPath"]."js/".$this->config["js"][$i],"js");
            }
        }

        return $assetTags;
    }
    /**
     * content is an abstract function that should be implemented by
     *the classes that inherit from this class
     * @abstract
     * @access protected
     */
   // abstract protected function content();

}?>
