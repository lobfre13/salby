<?php
        $mysqlHost = "localhost";
        $dbname = "salby";
        $dbUsername = "lobfre13";
        $dbPassword = "gruppe3";

        $database = new PDO("mysql:host=" . $mysqlHost . ";dbname=". $dbname, $dbUsername, $dbPassword);

        $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

