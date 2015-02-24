<?php

    function getMyClasses($user){
        global $database;
        $sql = $database->prepare("SELECT * FROM class
                                  JOIN mainteacher on id = classid
                                  WHERE username=:username");
        $sql->execute(array(
            'username' => $user->getUsername()
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getClass($id){
        global $database;
        $sql = $database->prepare("SELECT * FROM class WHERE id=:id");
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
        global $root;
        $class = getClass($id);
        $users = preg_replace('~[\r\n]+~', '',$_POST['users'] );
        $usernames = explode(';', trim($users));
        include $root.'/app/model/register.php';
        foreach($usernames as $username){
            if(isset($username))
            registerUser($username, $username, null, 'pupil', $class['id'], $class['schoolid']);
        }
    }

    function getClassSubjects($classID){
        global $database;
        $sql = $database->prepare("SELECT * FROM classsubject JOIN subject on subject.id = subjectid WHERE classid=:classid");
        $sql->execute(array(
            'classid' => $classID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getAllSubjects(){
        global $database;
        $sql = $database->prepare("SELECT * FROM subject");

        $sql->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function doAddSubject($classID){
        global $database;
        $sql = $database->prepare("INSERT INTO classsubject VALUES(null, :classID, :subjectID)");

        $sql->execute(array(
           'classID' => $classID,
            'subjectID' => $_POST['subjectid']
        ));
    }