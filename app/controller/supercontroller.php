<?php

    abstract class superController{
        private $register;
        protected $view;

        public function __construct($register){
            $this->setRegister($register);
            $this->initView();
            $this->checkUserAccess();
        }

        abstract protected function checkUserAccess();

        protected function getRegister(){
            return $this->register;
        }

        private function initView(){
            $this->view = new view('404.php');
            $this->view->root = $this->getRegister()->getRoot();
            $this->view->cssPath = $this->getCssPath();
        }

        private function setRegister($register){
            $this->register = $register;
        }

        protected function getCssPath(){
            return '/public/stylesheets/'.alias($this->getRegister()->getUrlElements()[0]).'.css';
        }

    }

