<?php
namespace app\view\template\Error;
use app;
use core;
/**
 * Error view Class
 *
 * Responsible for the rendering of the Error view also loads different asset configuration for it
 * by overriding loadConfig(so that configuration is loaded from the .ini in this directory)
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
class Error extends app\view\AppView
{

    /**
     * Returns the  title of the Error view
     * @override
     * @protevted
     * @return string
     */
    protected function title(){
        global $smarty;
        $smarty->assign("TITLE",$this->model->getErrorCode()."|".$this->model->getMessage());
        $smarty->assign("SUBTITLE","");
    }
    /**
     * Returns the  content of the Error view
     * @override
     * @access protected
     * @return string
     */
    protected function body(){
        global $smarty;
        $smarty->assign("ERROR_CODE", $this->model->getErrorCode());
        $smarty->assign("MESSAGE",$this->model->getMessage() );
        $smarty->assign("DETAILS",$this->model->getDetails() );
        $smarty->display(core\RouteHelper::getTemplatePath()."/index.tpl");
    }
    /**
     * Sets custom configuration implementation for this view
     * eg.loading it from the current directory
     * @override
     * @access protected
     * @return string
     */
    protected function loadConfig(){
        $this->config = parse_ini_file("config.ini");
    }

}
?>