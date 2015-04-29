<?php

    include_once 'db_con.php';

    function query($sqlString, $params, $fetchMode = DBI::FETCH_NONE){
        global $database;
        $sql = $database->prepare($sqlString);
        $sql->execute($params);
        if ($fetchMode == DBI::FETCH_ALL) return $sql->fetchAll(PDO::FETCH_ASSOC);
        else if ($fetchMode == DBI::FETCH_ONE) return $sql->fetch(PDO::FETCH_ASSOC);
        else if ($fetchMode == DBI::LAST_ID) return $database->lastInsertId();
        else if ($fetchMode == DBI::ROW_COUNT) return $sql->rowCount();
    }

    class DBI{
        const FETCH_ALL = 1;
        const FETCH_ONE = 2;
        const FETCH_NONE = 3;
        const LAST_ID = 4;
        const ROW_COUNT = 5;
    }