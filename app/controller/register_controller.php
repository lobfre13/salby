<?php
    class registerController{
        private $root;

        public function __construct($urlElements){
            $this->root = $GLOBALS->root;
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'GET')
                $this->index();
            else if($method == 'POST')
                $this->register();
        }

        private function index($regSuccess = false){
            include $this->root.'/app/views/template/header.php';
            include $this->root.'/app/views/register.php';
            include $this->root.'/app/views/template/footer.php';
        }

        private function register(){
            require $this->root.'/app/model/register.php';
            doRegister();;
            $this->index(true);
        }

    }