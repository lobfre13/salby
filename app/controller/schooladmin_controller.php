<?php
    class schooladminController{

        private $user;

        public function __construct($urlElements){
            $this->user = $_SESSION['user'];
            if(!isset($this->user) && !$this->user->isSchool()){
                header("Location: /login");
                exit;
            }
            include '/app/model/schooladmin.php';
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'GET')
                $this->index();
            else if($method == 'POST')
                $this->createSchoolClass();
        }

        private function index(){
            $schoolID = getSchoolID($this->user);
            $regkey = getRegkey($schoolID);
            $schoolClasses = getSchoolClasses($schoolID);
            $teachers = getSchoolTeachers($schoolID);

            include '/app/views/template/header.php';
            include '/app/views/template/headerMenu.php';
            include '/app/views/school/schooladmin.php';
            include '/app/views/template/footer.php';
        }

        private function createSchoolClass(){
            $schoolID = getSchoolID($this->user);
            doCreateSchoolClass($schoolID);
            $this->index();
        }

    }