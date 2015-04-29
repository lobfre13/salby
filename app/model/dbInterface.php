<?php

    include_once 'db_con.php';

function query($sqlString, $params, $fetchMode = 3)
{
        global $database;
        $sql = $database->prepare($sqlString);
        $sql->execute($params);
    if ($fetchMode == 1) return $sql->fetchAll(PDO::FETCH_ASSOC);
    else if ($fetchMode == 2) return $sql->fetch(PDO::FETCH_ASSOC);
    else if ($fetchMode == 4) return $database->lastInsertId();
    }