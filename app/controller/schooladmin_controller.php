<?php
    class schooladminController extends superController{

        public function __construct($register){
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/schooladmin.php';
            $this->routeAction();
        }

        protected function routeAction(){
            switch($this->getRegister()->getRequestMethod()){
                case 'GET':
                    $this->index();
                    break;
                case 'POST':
                    $this->createSchoolClass();
                    break;
            }
        }

        private function index(){
            $schoolID = getSchoolID($this->getRegister()->getUser());
            $regkey = getRegkey($schoolID);
            $schoolClasses = getSchoolClasses($schoolID);
            $teachers = getSchoolTeachers($schoolID);

            $this->showFullHeader();
            include $this->getRegister()->getRoot().'/app/views/school/schooladmin.php';
            $this->showFooter();
        }

        private function createSchoolClass(){
            $schoolID = getSchoolID($this->getRegister()->getUser());
            doCreateSchoolClass($schoolID);
            $this->index();
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user) || !$user->isSchool()){
                header("Location: /login");
                exit;
            }
        }

    }