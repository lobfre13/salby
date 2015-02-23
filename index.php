<?php
    $root = $_SERVER["DOCUMENT_ROOT"];

	require 'router.php';
    require $root.'app/model/db_con.php';
    require $root.'app/model/user.php';
    session_start();

    $router = new router();
    $router->loadController();