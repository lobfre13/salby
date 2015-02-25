<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 10:49
 */

    function doUpdateFavourite ($username, $lObjectId) {
        global $database;
        if ($this->doCheckIfFavouriteExist()) {
            $sql = $database->prepare("DELETE FROM Favourites WHERE Username = :username AND LearningobjectID = :lObjectId");
        } else {
            $sql = $database->prepare("INSERT INTO Favourites VALUES (:username, :lObjectId)");
        }
        $sql->execute(array(
            'username' => $username,
            'lObjectId' => $lObjectId
        ));
    }

    function doCheckIfFavouriteExist ($username, $lObjectId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM Favourites WHERE Username = :username AND LearningobjectID = :lObjectId");

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
        $sql = $database->prepare("SELECT * FROM LearningObjects WHERE ID = :id");

        $sql->execute(array(
            'id' => $id
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

