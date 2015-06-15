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
 * @throws \core\Exception\coreException
 * @author     Andreas Galazis <andreas@linx.ninja>
 * @copyright  2015 Andreas Galazis
 * @license    http://opensource.org/licenses/MIT  MIT License
 * @static
 */
class RouteHelper {
    const SMARTY_TEMPLATE_PATH= "app/view/template";
    /**
     * Filters the url and returns clean readable text
     * @static
     * @access private
     * @param string $input the input url to filter
     * @param bool $strip  whether to strip out HTML and PHP tags from the string
     * @return string
     */
    private static function filter($input,$strip) {
        $input = urldecode($input);
        $input = str_ireplace(array(
            "\0", '%00', "\x0a", '%0a', "\x1a", '%1a'), '', $input);
        if ($strip) {
            $input = strip_tags($input);
        }
        // or whatever encoding you use
        $input = htmlentities($input, ENT_QUOTES, 'utf-8');
        return trim($input);
    }
    /**
     * Returns an array of clean filtered strings that represent the current route
     * od the application... this can also be used for bread crumbs
     * @static
     * @access private
     * @param bool $strip  whether to strip out HTML and PHP tags from the url
     * @return array
     */
    private static function getRoute($strip = true) {
        $url=self::getRelativePath();
        $relativeURLParts=explode( "/",self::filter($url,$strip));
        $relativeURLParts = array_filter($relativeURLParts, function ($value) {
            return (!empty($value));
        });


        return $relativeURLParts;
    }
    /**
     * Returns the realative path to the current route
     * Yes no matter if your project sits in the document route or not!
     * @static
     * @access private
     * @return string
     */
    private static function getRelativePath(){
        $cleanURL=substr($_SERVER['REQUEST_URI'],strlen(BASENAME));
        if (isset(pathinfo($cleanURL)['extension'])) {
            return pathinfo($cleanURL)['dirname'];
        }
        return $cleanURL;
    }
    /**
     * Dispatches the current request
     * @static
     * @access public
     * @throws \core\Exception\coreException
     * @return void
     */

    public static function dispatch($default,$enforceDefault=false){
        $route=self::getRoute();
        if (count($route)>0&&!$enforceDefault){
            $mvc=$route[0];
        }else{
            $mvc=$default;
        }
        $modelClass="app\\model\\$mvc";
        $viewClass="app\\view\\template\\$mvc\\$mvc";
        $controllerClass="app\\controller\\$mvc";
         if  (class_exists($modelClass)&&class_exists($viewClass)&&class_exists($controllerClass)){
            $model=new $modelClass();
            new $controllerClass($model);
            new $viewClass($model);
        }else{

            throw new Exception\CoreException(404, "Not found");
        }
    }
    public static function getTemplatePath(){
        $route=self::getRoute();
        global $error;
        if (isset($error)){
            return self::SMARTY_TEMPLATE_PATH."/".constant("ERROR");
        }
        if (count($route)>0){
            $route=$route[0];

        }else{
            $route=constant("DEFAULT");
        }
        return self::SMARTY_TEMPLATE_PATH."/".$route;
    }


}