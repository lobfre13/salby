<?php
    class registerController extends superController{

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
                    $this->register();
                    break;
            }
        }

        private function index($regSuccess = false){
            $this->showHeader();
            include $this->getRegister()->getRoot().'/app/views/register.php';
            $this->showFooter();
        }

        private function register(){
            require $this->getRegister()->getRoot().'/app/model/register.php';
            doRegister();;
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