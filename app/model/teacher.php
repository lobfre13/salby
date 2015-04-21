<?php

    function getMyClasses($username){
        global $database;
        $sql = $database->prepare("SELECT c.classname, c.classlevel, s.subjectname, cs.id FROM classes as c
                                  JOIN classsubjects as cs ON cs.classid = c.id
                                  JOIN classsubjectteachers as cst ON cst.classsubjectid = cs.id
                                  JOIN subjects as s ON s.id = cs.subjectid
                                  WHERE cst.username = :username
                                  ORDER BY c.classlevel, c.classname");

        $sql->execute(array(
            'username' => $username
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getClassPupils($classID){
        global $database;
        $sql = $database->prepare("SELECT * FROM users
                                   WHERE classid = :classid");
        $sql->execute(array(
            'classid' => $classID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getClass($id){
        global $database;
        $sql = $database->prepare("SELECT * FROM classes WHERE id=:id");
        $sql->execute(array(
            'id' => $id
        ));
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function getPupils($classID){
        global $database;
        $sql = $database->prepare("SELECT * FROM users WHERE classid=:classid");
        $sql->execute(array(
            'classid' => $classID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function createUsers($id){
        global $rootPath;
        $class = getClass($id);
        $users = preg_replace('~[\r\n]+~', '',$_POST['users'] );
        $usernames = explode(';', trim($users));
        include $rootPath.'/app/model/register.php';
        foreach($usernames as $username){
            if(isset($username))
            registerUser($username, $username, null, 'pupil', $class['id'], $class['schoolid']);
        }
    }

    function getClassSubjects($classID){
        global $database;
        $sql = $database->prepare("SELECT * FROM classsubjects JOIN subjects on subjects.id = subjectid WHERE classid=:classid");
        $sql->execute(array(
            'classid' => $classID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllSubjects(){
        global $database;
        $sql = $database->prepare("SELECT * FROM subjects");

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function doAddSubject($classID){
        global $database;
        $sql = $database->prepare("INSERT INTO classsubjects VALUES(null, :classID, :subjectID)");

        $sql->execute(array(
           'classID' => $classID,
            'subjectID' => $_POST['subjectid']
        ));
    }

    function doGetClasses () {
        global $database;
        $sql = $database->prepare("SELECT * FROM classes");

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function doGetLearningObjects ($classId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM classes JOIN favourites ON");

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }