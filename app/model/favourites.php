<?php

    include_once 'dbInterface.php';

    function updateFavourite($username, $lObjectId, $url) {
        if (!favouriteExists($username, $lObjectId)) {
            addFavourite($username, $lObjectId, $url);
        } else {
            removeFavourite($username, $lObjectId);
        }
    }

    function addFavourite($username, $lObjectId, $url) {
        $sqlString = "INSERT INTO favourites VALUES (:username, :lObjectId, :url)";
        $params = array(
            'username' => $username,
            'lObjectId' => $lObjectId,
            'url' => $url
        );

        query($sqlString, $params);
    }

    function removeFavourite($username, $lObjectId) {
        $sqlString = "DELETE FROM favourites WHERE username = :username AND learningobjectid = :lObjectId";
        $params = array(
            'username' => $username,
            'lObjectId' => $lObjectId
        );

        query($sqlString, $params);
    }

    function favouriteExists($username, $lObjectId) {
        $sqlString = "SELECT * FROM favourites WHERE username = :username AND learningobjectid = :lObjectId";
        $params = array(
            'username' => $username,
            'lObjectId' => $lObjectId
        );

        return (query($sqlString, $params, DBI::ROW_COUNT) > 0);
    }

    function getUserFavourites($username) {
        $sqlString = "SELECT * FROM favourites
                      JOIN learningobjects ON learningobjects.id = learningobjectid
                      WHERE username = :username";
        $params = array('username' => $username);

        return query($sqlString, $params, DBI::FETCH_ALL);

    }

