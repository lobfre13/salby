<?php

    class loginController{

       public function __construct($urlElements){
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'GET')
                $this->index();
            else if($method == 'POST')
                $this->login();
        }

        private function index($failedLogin = false){
            include '/app/views/template/header.php';
            include '/app/views/login.php';
            include '/app/views/template/footer.php';
        }

        private function login(){
            require '/app/model/login.php';
            $loginSuccess = doLogin();
            if($loginSuccess)
                header("Location: /");
            else
                $this->index(true);
        }
    }