<?php
    include_once 'dbInterface.php';

    function doLogin(){

        if(isset($_POST['username']) && isset($_POST['password'])){

            $sqlString = "SELECT * FROM users WHERE username=:username AND password LIKE BINARY :password";
            $params = array(
                'username' => $_POST['username'],
                'password' => $_POST['password']
            );

            $result = query($sqlString, $params, DBI::FETCH_ONE);

            if(is_array($result) && !arrayEmpty($result)){
                $_SESSION['user'] = new User($_POST['username'], $result['classid'], $result['role'], $result['firstname'], $result['lastname']);
                return true;
            }
            else{
                return false;
            }
        }
    }
