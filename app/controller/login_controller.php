<?php

    class loginController{
        private $root;

       public function __construct($urlElements){
           $this->root = $GLOBALS->root;
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'GET')
                $this->index();
            else if($method == 'POST')
                $this->login();
        }

        private function index($failedLogin = false){
            include $this->root.'app/views/template/header.php';
            include $this->root.'app/views/login.php';
            include $this->root.'app/views/template/footer.php';
        }

        private function login(){
            require $this->root.'app/model/login.php';
            $loginSuccess = doLogin();
            if($loginSuccess)
                header("Location: /");
            else
                $this->index(true);
        }
    }