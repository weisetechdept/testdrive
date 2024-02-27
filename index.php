<?php
    require 'vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get( '/', function() {
        header('Location: /booking');
    });

    /* sales */

    $router->get( '/sales/home', function() {
        require_once('sales/pages/home.php');
    });

    $router->get( '/sales/booking', function() {
        require_once('sales/pages/booking.php');
    });

    $router->get( '/sales/list', function() {
        require_once('sales/pages/list.php');
    });

    $router->get( '/sales/de/(.*)', function($id) {
        require_once('sales/pages/detail.php');
    });

    /* frontend */

    $router->get( '/booking', function() {
        require_once('frontend/pages/booking.php');
    });

    $router->get( '/thank', function() {
        require_once('frontend/pages/thank.php');
    });

    /* inbound */

    $router->get( '/admin/booking/(.*)', function($branch) {
        require_once('inbound/pages/booking.php');
    });

    $router->get( '/admin/de/(.*)', function($id) {
        require_once('inbound/pages/detail.php');
    });

    $router->get( '/admin/quota', function() {
        require_once('inbound/pages/quota.php');
    });

    $router->run();
    



