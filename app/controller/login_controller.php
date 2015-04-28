<?php

    class loginController extends superController{

        public function __construct($register){
            parent::__construct($register);
        }

        public function index($failedLogin = false){
            $this->view->setViewPath('login.php');
            $this->view->hideHeaderMenu(true);
            $this->view->failedLogin = $failedLogin;
            $this->view->showPage();
        }

        public function login(){
            require $this->root.'/app/model/login.php';
            $loginSuccess = doLogin();
            if($loginSuccess)
                header("Location: /");
            else
                $this->index(true);
        }

        protected function checkUserAccess(){
            $user = $this->user;
            if(isset($user)){
                header("Location: /");
                exit;
            }
        }
    }