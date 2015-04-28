<?php
    class User{
        private $data;

        function __construct($username, $classID, $role, $firstname, $lastname){
            $this->username = $username;
            $this->classID = $classID;
            $this->role = $role;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
        }

        public function __get($attribute){
            if(isset($this->data[$attribute])) return $this->data[$attribute];
            else return null;
        }

        public function __set($key, $val) {
            $this->data[$key] = $val;
        }

        public function isAdmin(){
            return $this->role === 'admin';
        }

        public function isSchool(){
            return $this->role === 'school';
        }

        public function isTeacher(){
            return $this->role === 'teacher';
        }

        public function getFullName(){
            return $this->firstname . ' ' . $this->lastname;
        }
    }