<?php
    $rootPath = $_SERVER["DOCUMENT_ROOT"];

	require 'router.php';
	require 'routes.php';
    require $rootPath.'/app/controller/supercontroller.php';
    require $rootPath.'/app/model/user.php';
    require $rootPath.'/app/views/view.php';
    session_start();

    $router = new Router();
    $router->loadController();