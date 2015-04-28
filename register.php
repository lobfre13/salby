<?php
    class register{
        private $data;

        function __construct($root, $user, $urlElements, $requestMethod){
            $this->root = $root;
            $this->user = $user;
            $this->urlElements = $urlElements;
            $this->requestMethod = $requestMethod;
        }

        public function __get($attribute){
            if(isset($this->data[$attribute])) return $this->data[$attribute];
            else return null;
        }

        public function __set($key, $val) {
            $this->data[$key] = $val;
        }

        public function getData(){
            return $this->data;
        }
    }