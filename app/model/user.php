<?php
    class User{
        private $role;
        private $username;
        private $classID;

        function __construct($username, $classID, $role){
            $this->setUsername($username);
            $this->setClassID($classID);
            $this->setRole($role);
        }

        public function getRole(){
            return $this->role;
        }

        public function setRole($role){
            $this->role = $role;
        }

        public function getUsername(){
            return $this->username;
        }

        public function setUsername($username){
            $this->username = $username;
        }

        public function getClassID(){
            return $this->classID;
        }

        public function setClassID($classID){
            $this->classID = $classID;
        }

        public function isAdmin(){
            return $this->getRole() === 'admin';
        }
        public function isSchool(){
            return $this->getRole() === 'school';
        }
        public function isTeacher(){
            return $this->getRole() === 'teacher';
        }
    }