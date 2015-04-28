<?php

    abstract class superController{
        private $data;
        protected $view;

        public function __construct($register){
            $this->data = $register->getData();
            $this->initView();
            $this->checkUserAccess();
        }

        abstract protected function checkUserAccess();

        public function __get($attribute){
            if(isset($this->data[$attribute])) return $this->data[$attribute];
            else return null;
        }

        public function __set($key, $val) {
            $this->data[$key] = $val;
        }

        private function initView(){
            $this->view = new view('404.php');
            $this->view->root = $this->root;
            $this->view->cssPath = $this->getCssPath();
        }

        protected function getCssPath(){
            return '/public/stylesheets/'.alias($this->urlElements[0]).'.css';
        }

    }

