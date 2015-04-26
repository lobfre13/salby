<?php
    class schooladminController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->getRegister()->getRoot().'/app/model/schooladmin.php';
            include $this->getRegister()->getRoot().'/app/model/teacher.php';
        }

        public function index(){
            $schoolID = getSchoolID($this->getRegister()->getUser()->getUsername());
            $school = getSchool($schoolID);
            $this->view->setViewPath('school/schooladmin.php');
            $this->view->schoolName = $school['name'];
            $this->view->showPage();
        }

        public function getClasses(){
            $schoolID = getSchoolID($this->getRegister()->getUser()->getUsername());
            $classLevel = $this->getRegister()->getUrlElements()[2];
            $this->view->setViewPath("school/partialviews/schoolClassesInLevel.php");
            $this->view->schoolClasses = getClassesInLevel($schoolID, $classLevel);
            $this->view->showStrippedPage();
        }

        public function getClassPupils(){
            $schoolID = getSchoolID($this->getRegister()->getUser()->getUsername());
            $classid = $this->getRegister()->getUrlElements()[2];
            $this->view->setViewPath("school/partialviews/classPupils.php");
            $this->view->mainTeacher = getMainTeacher($classid);
            $this->view->classPupils = getClassPupils($classid);
            $this->view->classID = $classid;
            $this->view->schoolTeachers = getSchoolTeachers($schoolID);
            $this->view->showStrippedPage();
        }

        public function newSchoolClass(){
            $schoolID = getSchoolID($this->getRegister()->getUser()->getUsername());
            $school = getSchool($schoolID);
            $this->view->setViewPath("school/newSchoolClass.php");
            $this->view->schoolName = $school['name'];
            $this->view->showPage();
        }

        public function newTeacher(){
            $schoolID = getSchoolID($this->getRegister()->getUser()->getUsername());
            $school = getSchool($schoolID);
            $this->view->setViewPath("school/newTeacher.php");
            $this->view->schoolName = $school['name'];
            $this->view->showPage();
        }

        public function registerNewTeacher(){
            $schoolID = getSchoolID($this->getRegister()->getUser()->getUsername());
            registerTeacher($_POST['firstname'],$_POST['lastname'], $_POST['email'], $_POST['username'], $_POST['password'], $schoolID);
            $this->index();
        }

        public function addNewSchoolClass(){
            $schoolID = getSchoolID($this->getRegister()->getUser()->getUsername());
            addNewSchoolClass($schoolID, $_POST['className'], $_POST['classLevel']);
            $this->index();
        }

        public function addNewPupilToClass(){
            $schoolID = getSchoolID($this->getRegister()->getUser()->getUsername());
            addNewPupilToClass($schoolID, $_POST['classid'], $_POST['firstname'], $_POST['lastname']);
            $this->index();
        }

        public function updateMainTeacher(){
            updateMainTeacher($_POST['classid'], $_POST['mainTeacher']);
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