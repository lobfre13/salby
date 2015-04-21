<?php

    function updateFavourite($username, $lObjectId, $url) {
        if (!favouriteExists($username, $lObjectId)) {
            addFavourite($username, $lObjectId, $url);
        } else {
            removeFavourite($username, $lObjectId);
        }
    }

    function addFavourite($username, $lObjectId, $url) {
        global $database;
        $sql = $database->prepare("INSERT INTO favourites VALUES (:username, :lObjectId, :url)");

        $sql->execute(array(
            'username' => $username,
            'lObjectId' => $lObjectId,
            'url' => $url
        ));
    }

    function removeFavourite($username, $lObjectId) {
        global $database;
        $sql = $database->prepare("DELETE FROM favourites WHERE username = :username AND learningobjectid = :lObjectId");

        $sql->execute(array(
            'username' => $username,
            'lObjectId' => $lObjectId
        ));
    }

    function favouriteExists($username, $lObjectId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM favourites WHERE username = :username AND learningobjectid = :lObjectId");

        $sql->execute(array(
            'username' => $username,
            'lObjectId' => $lObjectId
        ));
        return ($sql->rowCount() > 0);
    }

    function getUserFavourites($username) {
        global $database;
        $sql = $database->prepare("SELECT * FROM favourites
                  JOIN learningobjects ON learningobjects.id = learningobjectid
                  WHERE username = :username");
        $sql->execute(array(
            'username' => $username
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

