<?php
    function doLogin(){

        if(isset($_POST['username']) && isset($_POST['password'])){
            global $database;
            $sql = $database->prepare("SELECT * FROM users WHERE username=:username AND password=:password");

            $sql->execute(array(
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ));
            $data = $sql->rowCount();
            $result = $sql->fetch(PDO::FETCH_ASSOC);

            if($data == 1){
                $_SESSION['user'] = new User($_POST['username'], $result['classid'], $result['role'], $result['firstname'], $result['lastname']);
                return true;
            }
            else{
                return false;
            }
        }
    }
