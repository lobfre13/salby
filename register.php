<?php
    class register{
        private $root;
        private $user;
        private $urlElements;
        private $requestMethod;

        function __construct($root, $user, $urlElements, $requestMethod){
            $this->setRoot($root);
            $this->setUser($user);
            $this->setUrlElements($urlElements);
            $this->setRequestMethod($requestMethod);
        }

        public function getRoot(){
            return $this->root;
        }

        private function setRoot($root){
            $this->root = $root;
        }

        public function getUser(){
            return $this->user;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function getUrlElements(){
            return $this->urlElements;
        }

        private function setUrlElements($urlElements){
            $this->urlElements = $urlElements;
        }

        public function getRequestMethod(){
            return $this->requestMethod;
        }

        private function setRequestMethod($requestMethod){
            $this->requestMethod = $requestMethod;
        }
    }