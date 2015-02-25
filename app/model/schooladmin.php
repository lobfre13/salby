<?php

    function getSchoolID($user){
        global $database;
        $sql = $database->prepare("SELECT * FROM users WHERE username=:userid");

        $sql->execute(array(
            'userid' => $user->getUsername()
        ));

        return $sql->fetch(PDO::FETCH_ASSOC)['schoolid'];
    }

    function getRegkey($schoolID){
        global $database;
        $sql = $database->prepare("SELECT * FROM schools WHERE id=:id");

        $sql->execute(array(
            'id' => $schoolID
        ));
        return $sql->fetch(PDO::FETCH_ASSOC)['regkey'];
    }

    function getSchoolClasses($schoolID){
        global $database;
        $sql = $database->prepare("SELECT * FROM classes " .
            "LEFT JOIN mainteachers ON id = classid " .
            "WHERE schoolid=:schoolid");

        $sql->execute(array(
            'schoolid' => $schoolID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getSchoolTeachers($schoolID){
        global $database;
        $sql = $database->prepare("SELECT * FROM users WHERE schoolid=:schoolid AND role=:role");

        $sql->execute(array(
            'schoolid' => $schoolID,
            'role' => 'teacher'
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function doCreateSchoolClass($schoolID){
        global $database;
        $sql = $database->prepare("INSERT INTO classes VALUES(null, :schoolid, :classname, :classlevel)");

        $sql->execute(array(
            'schoolid' => $schoolID,
            'classname' => $_POST['classname'],
            'classlevel' => $_POST['classlevel']
        ));
        $classID = $database->lastInsertId();

        $sql = $database->prepare("INSERT INTO mainteachers VALUES(:username, :classid)");

        $sql->execute(array(
           'username' => $_POST['mainteacher'],
            'classid' => $classID
        ));
    }