<?php

    function getMyClasses($user){
        global $database;
        $sql = $database->prepare("SELECT * FROM classes
                                  JOIN mainteachers on id = classid
                                  WHERE username=:username order by classlevel, classname");
        $sql->execute(array(
            'username' => $user->getUsername()
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