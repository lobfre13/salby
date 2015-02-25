<?php

    function doRegister(){
        if(isset($_POST['regtype'])) {
            //            Valider input her!!
            //            Valider input her!!
            if($_POST['regtype'] == 'school'){
                registerSchool($_POST['username'], $_POST['password'], $_POST['email']);
            }
            else if($_POST['regtype'] == 'teacher'){
                registerTeacher($_POST['username'], $_POST['password'], $_POST['email']);
            }
            else if($_POST['regtype'] == 'user'){
                registerUser($_POST['username'], $_POST['password'], $_POST['email'], 'pupil');
            }
        }
    }

    function registerUser($username, $password, $email, $role, $classID = null, $schoolID = null){
        global $database;
        $sql = $database->prepare("INSERT INTO users VALUES(:username, :password, :email, :role, :classID, :schoolID)");

        $sql->execute(array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'role' => $role,
            'classID' => $classID,
            'schoolID' => $schoolID
        ));
    }

    function registerSchool($username, $password, $email){
        global $database;
        $sql = $database->prepare("INSERT INTO schools VALUES(null, :schoolname, null, null, :regkey)");

        $sql->execute(array(
            'schoolname' => $_POST['schoolname'],
            'regkey' => md5(time())
        ));

        $schoolID = $database->lastInsertId();
        registerUser($username, $password, $email, 'school', null, $schoolID);
    }

    function registerTeacher($username, $password, $email){
        global $database;
        $sql = $database->prepare("SELECT * FROM schools WHERE regkey=:regkey");
        $sql->execute(array(
            'regkey' => $_POST['schoolkey']
        ));

        $rowCount = $sql->rowCount();
        if($rowCount == 1){
            $schoolID = $sql->fetch(PDO::FETCH_ASSOC)['id'];
            registerUser($username, $password, $email, 'teacher', null, $schoolID);
        }
    }