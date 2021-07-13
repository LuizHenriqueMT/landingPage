<?php
require '../vendor/autoload.php';
require __DIR__.'/../bootstrap.php';    

$request = new app\src\request;
$router->resolve($request);

//$router->GET('teste/{id}', 'Controller@method');


?>