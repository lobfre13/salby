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

    //function doGetParent ()

    function doGetClass ($classId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM classes WHERE id = :classId");

        $sql->execute(array(
            'classId' => $classId
        ));

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function doGetWeekNumber () {
        date_default_timezone_set(date_default_timezone_get());
        $date = date('m/d/Y h:i:s a', time());
        $dateTime = new DateTime($date);
        $week = $dateTime->format("W");
        return $week;
    }

    function doGetStudentFullName ($username) {
        global $database;
        $sql = $database->prepare("SELECT * FROM users WHERE username = :username");

        $sql->execute(array(
            'username' => $username
        ));

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function doGetSubject ($classId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects
          JOIN learningobjectcategory ON learningobjectid = learningobjects.id
          JOIN categories ON categories.id = categoryid
          JOIN subjectcategory ON categories.id = subjectcategory.categoryid
          JOIN subjects ON subjectid = subjects.id
          JOIN homework ON homework.learningobjectid = learningobjects.id
          JOIN classsubjects ON classsubjectid = classsubjects.id
          WHERE classid = :classId");

        $sql->execute(array(
            'classId' => $classId
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function doGetLearninObjectUrl ($learningObjectId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects WHERE id = :learningobjectid");

        $sql->execute(array(
            'learningobjectid' => $learningObjectId
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
