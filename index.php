<?php
	require 'router.php';
    require '/app/model/db_con.php';
    require '/app/model/user.php';
    session_start();

    $router = new router();
    $router->loadController();