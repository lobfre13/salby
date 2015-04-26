<?php

    function getSchoolID($username){
        global $database;
        $sql = $database->prepare("SELECT * FROM users WHERE username=:username");

        $sql->execute(array(
            'username' => $username
        ));

        return $sql->fetch(PDO::FETCH_ASSOC)['schoolid'];
    }

    function getSchool($schoolID){
        global $database;
        $sql = $database->prepare("SELECT * FROM schools WHERE id=:id");

        $sql->execute(array(
            'id' => $schoolID
        ));
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function getClassesInLevel($schoolID, $classLevel){
        global $database;
        $sql = $database->prepare("SELECT * FROM classes
            LEFT JOIN mainteachers ON id = classid
            WHERE schoolid=:schoolid AND classlevel = :classlevel");

        $sql->execute(array(
            'schoolid' => $schoolID,
            'classlevel' => $classLevel
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function registerTeacher($firstname, $lastname, $email, $username, $passowrd, $schoolid){
        global $database;
        $sql = $database->prepare("INSERT INTO users VALUES(:username, :password, :firstname, :lastname, :email, 'teacher', null, :schoolid)");
        $sql->execute(array(
           'username' => $username,
            'password' => $passowrd,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'schoolid' => $schoolid
        ));
    }

    function addNewSchoolClass($schoolID, $className, $classLevel){
        global $database;
        $sql = $database->prepare("INSERT INTO classes VALUES(null, :schoolid, :classname, :classlevel)");
        $sql->execute(array(
            'schoolid' => $schoolID,
            'classname' => $className,
            'classlevel' => $classLevel
        ));
    }

    function getMainTeacher($classID){
        global $database;
        $sql = $database->prepare("SELECT * FROM mainteachers
                                   JOIN users ON users.username = mainteachers.username
                                   WHERE mainteachers.classid = :classid");
        $sql->execute(array(
            'classid' => $classID
        ));
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function addNewPupilToClass($schoolid, $classid, $firstname, $lastname){
        $username = substr($lastname, 0, 3).substr($firstname, 0,3);
        global $database;
        $sql = $database->prepare("INSERT INTO users VALUES(:username, :password, :firstname, :lastname, null, 'pupil', :classid, :schoolid)");
        $sql->execute(array(
            'username' => $username,
            'password' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'classid' => $classid,
            'schoolid' => $schoolid
        ));
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

    function updateMainTeacher($classid, $username){
        global $database;
        $sql = $database->prepare("DELETE FROM mainteachers WHERE classid = :classid");
        $sql->execute(array('classid' => $classid));
        $sql = $database->prepare("INSERT INTO mainteachers VALUES(:username, :classid)");
        $sql->execute(array('username' => $username, 'classid' => $classid));
    }

//    function getRegkey($schoolID){
//        global $database;
//        $sql = $database->prepare("SELECT * FROM schools WHERE id=:id");
//
//        $sql->execute(array(
//            'id' => $schoolID
//        ));
//        return $sql->fetch(PDO::FETCH_ASSOC)['regkey'];
//    }
//
//    function getSchoolClasses($schoolID){
//        global $database;
//        $sql = $database->prepare("SELECT * FROM classes " .
//            "LEFT JOIN mainteachers ON id = classid " .
//            "WHERE schoolid=:schoolid");
//
//        $sql->execute(array(
//            'schoolid' => $schoolID
//        ));
//        return $sql->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//
//
//    function doCreateSchoolClass($schoolID){
//        global $database;
//        $sql = $database->prepare("INSERT INTO classes VALUES(null, :schoolid, :classname, :classlevel)");
//
//        $sql->execute(array(
//            'schoolid' => $schoolID,
//            'classname' => $_POST['classname'],
//            'classlevel' => $_POST['classlevel']
//        ));
//        $classID = $database->lastInsertId();
//
//        $sql = $database->prepare("INSERT INTO mainteachers VALUES(:username, :classid)");
//
//        $sql->execute(array(
//           'username' => $_POST['mainteacher'],
//            'classid' => $classID
//        ));
//    }