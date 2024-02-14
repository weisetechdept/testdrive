<?php
    require 'vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get( '/', function() {
        header("location: /404");
		exit();
    });

    $router->get( '/sales/booking', function() {
        header("location: /sales/pages/booking.php");
		exit();
    });

    $router->get( '/sales/list', function() {
        header("location: /sales/pages/list.php");
		exit();
    });

    $router->run();
    



