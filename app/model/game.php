<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 10:49
 */

    function doUpdateFavourite ($username, $lObjectId) {
        global $database;
        if (doCheckIfFavouriteExist($username, $lObjectId)) {
            $sql = $database->prepare("DELETE FROM favourites WHERE username = :username AND laeringobjectid = :lObjectId");
        } else {
            $sql = $database->prepare("INSERT INTO favourites VALUES (:username, :lObjectId)");
        }
        $sql->execute(array(
            'username' => $username,
            'lObjectId' => $lObjectId
        ));
    }

    function doCheckIfFavouriteExist ($username, $lObjectId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM favourites WHERE username = :username AND laeringobjectid = :lObjectId");

        $sql->execute(array(
            'username' => $username,
            'lObjectId' => $lObjectId
        ));

        if ($sql->rowCount() > 0) {
            return true;
        }
        return false;
    }

    function doGetLObject ($id) {
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects WHERE ID = :id");

        $sql->execute(array(
            'id' => $id
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

