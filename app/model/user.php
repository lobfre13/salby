<?php
    class User{
        private $role;
        private $username;
        private $classID;
        private $firstname;
        private $lastname;

        function __construct($username, $classID, $role, $firstname, $lastname){
            $this->setUsername($username);
            $this->setClassID($classID);
            $this->setRole($role);
            $this->setFirstname($firstname);
            $this->setLastname($lastname);
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

        public function getFirstname(){
            return $this->firstname;
        }

        public function setFirstname($firstname){
            $this->firstname = $firstname;
        }

        public function getLastname(){
            return $this->lastname;
        }

        public function setLastname($lastname){
            $this->lastname = $lastname;
        }
        public function getFullName(){
            return $this->getFirstname() . ' ' . $this->getLastname();
        }
    }