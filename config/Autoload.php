<?php
/**
 * Auto loader script
 *
 * Auto loader for loading packages as required
 * on a linux machine
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
 */
function autoload_class ( $namespace_class ){
// Adapt to OS. Windows uses '\' as directory separator, linux uses '/'
    $path_file = str_replace('\\', DIRECTORY_SEPARATOR, $namespace_class);

// Get the autoload extentions in an array
    $autoload_extensions = explode(',', spl_autoload_extensions());

// Loop over the extensions and load accordingly
    foreach ($autoload_extensions as $autoload_extension) {
        include_once($path_file . $autoload_extension);
    }
}

// Setting the path (I use linux) so our includes work.
set_include_path( get_include_path() . PATH_SEPARATOR . './' );

// Only try to autoload files with this extension(s)
spl_autoload_extensions( '.php' );

// Register our autoload_class function as the spl_autoload implementation to use
spl_autoload_register( 'autoload_class' );
?>