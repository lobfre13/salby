<?php

    include_once 'db_con.php';

    function query($sqlString, $params, $fetchAll){
        global $database;
        $sql = $database->prepare($sqlString);
        $sql->execute($params);
        if($fetchAll) return $sql->fetchAll(PDO::FETCH_ASSOC);
        else return $sql->fetch(PDO::FETCH_ASSOC);
    }