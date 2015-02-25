<?php

    class loginController extends superController{

        public function __construct($register){
            parent::__construct($register);
            $this->checkUserAccess();
            $this->routeAction();

        }
        protected function routeAction(){
            switch($this->getRegister()->getRequestMethod()){
                case 'GET':
                    $this->index();
                    break;
                case 'POST':
                    $this->login();
                    break;
            }
        }

        private function index($failedLogin = false){
            $this->showHeader();
            include $this->getRegister()->getRoot().'/app/views/login.php';
            $this->showFooter();
        }

        private function login(){
            require $this->getRegister()->getRoot().'/app/model/login.php';
            $loginSuccess = doLogin();
            if($loginSuccess)
                header("Location: /");
            else
                $this->index(true);
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(isset($user)){
                header("Location: /");
                exit;
            }
        }
    }