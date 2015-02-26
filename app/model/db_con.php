<?php
        $mysqlHost = "localhost";
        $dbname = "salaby";
        $dbUsername = "lobfre13";
        $dbPassword = "gruppe3";

        $database = new PDO("mysql:host=" . $mysqlHost . ";dbname=". $dbname. ";charset=utf8", $dbUsername, $dbPassword);

        $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

