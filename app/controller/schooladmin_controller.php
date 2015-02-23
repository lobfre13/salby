<?php
    class schooladminController{

        private $user;
        private $root;

        public function __construct($urlElements){
            $this->root = $GLOBALS->root;
            $this->user = $_SESSION['user'];
            if(!isset($this->user) && !$this->user->isSchool()){
                header("Location: /login");
                exit;
            }
            include $this->root.'/app/model/schooladmin.php';
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

            include $this->root.'/app/views/template/header.php';
            include $this->root.'/app/views/template/headerMenu.php';
            include $this->root.'/app/views/school/schooladmin.php';
            include $this->root.'/app/views/template/footer.php';
        }

        private function createSchoolClass(){
            $schoolID = getSchoolID($this->user);
            doCreateSchoolClass($schoolID);
            $this->index();
        }

    }