<?php

    abstract class superController{
        private $register;

        public function __construct($register){
            $this->setRegister($register);
        }

        abstract protected function checkUserAccess();
        abstract protected function routeAction();

        protected function showHeader(){
            $cssPath = $this->getCssPath();
            include $this->getRegister()->getRoot().'/app/views/template/header.php';
        }

        protected function showFullHeader(){
            $this->showHeader();

            include $this->getRegister()->getRoot().'/app/views/template/headerMenu.php';
        }

        protected function showFooter(){
            include $this->getRegister()->getRoot().'/app/views/template/footer.php';
        }

        protected function getRegister(){
            return $this->register;
        }

        private function setRegister($register){
            $this->register = $register;
        }

        private function getCssPath(){
            return '/public/stylesheets/'.$this->getRegister()->getUrlElements()[0].'.css';
        }

    }

