<?php
    require 'vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get( '/', function() {
        header('Location: /booking');
    });

    $router->get( '/404', function() {
        require_once('404.php');
    });

    /* Login */
    $router->get( '/sales/auth', function() {
        require_once('sales/pages/auth.php');
    });

    /* sales */
    $router->get( '/sales/home', function() {
        require_once('sales/pages/home.php');
    });

    $router->get( '/sales/booking', function() {
        require_once('sales/pages/booking-new.php');
    });

    $router->get( '/sales/list', function() {
        require_once('sales/pages/list.php');
    });

    $router->get( '/sales/de/(.*)', function($id) {
        require_once('sales/pages/detail.php');
    });

    $router->get( '/sales/check', function() {
        require_once('sales/pages/checkEvent.php');
    });

    /* frontend */
    $router->get( '/booking', function() {
        require_once('frontend/pages/booking.php');
    });

    $router->get( '/thank', function() {
        require_once('frontend/pages/thank.php');
    });

    /* inbound */

    $router->get( '/admin/fastlane', function() {
        require_once('inbound/pages/fastlane.php');
    });

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

    $router->get( '/admin/detail/mv/(.*)', function($id) {
        require_once('inbound/pages/move-booking.php');
    });

    $router->get( '/admin/addquota/', function() {
        require_once('inbound/pages/add-quota.php');
    });

    $router->get( '/admin/report/', function() {
        require_once('inbound/pages/report.php');
    });

    $router->get( '/admin/report-mgr/', function() {
        require_once('inbound/pages/report-mgr.php');
    });

    $router->get( '/admin/rmgr/(.*)/(.*)/(.*)/(.*)', function($rtype,$group,$dtype,$date) {
        require_once('inbound/pages/report-mgr-detail.php');
    });

    $router->get( '/admin/event', function() {
        require_once('inbound/pages/event.php');
    });

    $router->get( '/admin/addevent', function() {
        require_once('inbound/pages/add-event.php');
    });

    /* mgr */

    $router->get( '/mgr/login', function() {
        require_once('mgr/pages/login.php');
    });

    $router->get( '/mgr/auth', function() {
        require_once('mgr/pages/auth.php');
    });

    $router->get( '/mgr/home', function() {
        require_once('mgr/pages/home.php');
    });

    $router->get( '/mgr/booking', function() {
        require_once('mgr/pages/booking-new.php');
    });

    $router->get( '/mgr/testBk/(.*)', function($date) {
        require_once('mgr/pages/testBk.php');
    });

    $router->get( '/mgr/alllist/(.*)', function($id) {
        require_once('mgr/pages/all-list.php');
    });

    $router->get( '/mgr/list/(.*)/(.*)', function($id, $date) {
        require_once('mgr/pages/list.php');
    });

    $router->get( '/mgr/de/(.*)', function($id) {
        require_once('mgr/pages/detail.php');
    });

    $router->get( '/mgr/report/', function() {
        require_once('mgr/pages/report.php');
    });

    $router->get( '/mgr/adsign/(.*)', function($date) {
        require_once('mgr/pages/adsign.php');
    });

    $router->get( '/mgr/done/(.*)', function($date) {
        require_once('mgr/pages/done.php');
    });

    $router->get( '/mgr/cancel/(.*)', function($date) {
        require_once('mgr/pages/cancel.php');
    });

    $router->get( '/mgr/makeBk', function() {
        require_once('mgr/pages/makeBk.php');
    });

    $router->get( '/mgr/check', function() {
        require_once('mgr/pages/checkEvent.php');
    });

    $router->get( '/mgr/send/(.*)', function($id) {
        require_once('mgr/pages/send-booking.php');
    });


    $router->run();
    



