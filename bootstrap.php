<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

require __DIR__.'/vendor/autoload.php';

use app\src\router;

session_start();

try{
    $router = new router;

    require __DIR__.'/routes/routes.php';
}
catch(\Exception $e){
    echo $e->getMessage();
}


?>