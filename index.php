<?php
    require 'vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get( '/', function() {
        header('Location: /booking');
    });

    /* sales */

    $router->get( '/sales/login', function() {
        require_once('sales/pages/login.php');
    });

    $router->get( '/sales/auth', function() {
        require_once('sales/pages/auth.php');
    });

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

    $router->get( '/admin/auth', function() {
        require_once('inbound/pages/auth.php');
    });

    $router->get( '/admin/addcar', function() {
        require_once('inbound/pages/add-car.php');
    });

    $router->get( '/admin/home', function() {
        require_once('inbound/pages/home.php');
    });

    $router->get( '/admin/booking/(.*)', function($branch) {
        require_once('inbound/pages/booking.php');
    });

    $router->get( '/admin/de/(.*)', function($id) {
        require_once('inbound/pages/detail.php');
    });

    $router->get( '/admin/quota', function() {
        require_once('inbound/pages/quota.php');
    });

    $router->get( '/admin/car', function() {
        require_once('inbound/pages/car.php');
    });

    $router->get( '/admin/cd/(.*)', function($id) {
        require_once('inbound/pages/car-detail.php');
    });

    $router->get( '/admin/ce/(.*)', function($id) {
        require_once('inbound/pages/car-edit.php');
    });

    $router->get( '/admin/addquota/', function() {
        require_once('inbound/pages/add-quota.php');
    });

    $router->run();
    



