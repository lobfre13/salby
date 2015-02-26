<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 15:09
 */

    function doGetHomework ($classId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects
          JOIN homework ON homework.learningobjectid = learningobjects.id
          JOIN classsubjects ON classsubjects.id = homework.classsubjectid
          WHERE classid = :classId");

        $sql->execute(array(
            'classId' => $classId
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function doGetFavourites ($username) {
        global $database;
        $sql = $database->prepare("SELECT * FROM favourites
          JOIN learningobjects ON learningobjects.id = learningobjectid
          WHERE username = :username");

        $sql->execute(array(
            'username' => $username
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function doGetClass ($classId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM classes WHERE id = :classId");

        $sql->execute(array(
            'classId' => $classId
        ));

        return $sql->fetch(PDO::FETCH_ASSOC);
    }