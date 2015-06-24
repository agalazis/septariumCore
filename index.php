<?php
date_default_timezone_set("Europe/Athens");
require 'libs/Smarty/libs/Smarty.class.php';
global $smarty;
//change the default  from some endpoint to
//whatever mvc end point you prefer
DEFINE("DEFAULT","SomeEndpoint" );
DEFINE("ERROR","Error" );
$smarty= new Smarty();
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
$smarty->force_compile = true;
include_once "config/Autoload.php";
define("BASENAME",pathinfo($_SERVER['SCRIPT_NAME'])['dirname'] );
try {
    core\RouteHelper::dispatch(constant("DEFAULT"));
}catch (Exception $e) {
    global $error;
    $error=$e;
    core\RouteHelper::dispatch(constant("ERROR"),true);

}
