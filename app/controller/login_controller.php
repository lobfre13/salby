<?php

    class LoginController extends SuperController{

        public function __construct($register){
            parent::__construct($register);
            include $this->root.'/app/model/webutility.php';
            include $this->root.'/app/model/login.php';

        }

        public function index($failedLogin = false){
            $this->view->setViewPath('login.php');
            $this->view->hideHeaderMenu(true);
            $this->view->failedLogin = $failedLogin;
            $this->view->showPage();
        }

        public function login(){
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