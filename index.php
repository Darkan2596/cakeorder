<?php

include_once 'application/libraries/Autoloader.php';

Autoloader::register();

$route = new Route();

$route->defaultRedirection();
