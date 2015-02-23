<?php
    class registerController{

        public function __construct($urlElements){
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'GET')
                $this->index();
            else if($method == 'POST')
                $this->register();
        }

        private function index($regSuccess = false){
            include '/app/views/template/header.php';
            include '/app/views/register.php';
            include '/app/views/template/footer.php';
        }

        private function register(){
            require '/app/model/register.php';
            doRegister();;
            $this->index(true);
        }

    }