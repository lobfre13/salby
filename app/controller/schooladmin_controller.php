<?php
    class schooladminController extends superController{

        public function __construct($register){
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/schooladmin.php';
//            $this->routeAction();
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

        public function index(){
            $this->view->setViewPath('school/schooladmin.php');
            $this->view->schoolID = getSchoolID($this->getRegister()->getUser());
            $this->view->regkey = getRegkey($this->view->schoolID);
            $this->view->schoolClasses = getSchoolClasses($this->view->schoolID);
            $this->view->teachers = getSchoolTeachers($this->view->schoolID);
            $this->view->showPage();
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