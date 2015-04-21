<?php
    class teacherController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->getRegister()->getRoot().'/app/model/teacher.php';
        }

        public function index(){
            $this->view->setViewPath('teacher/teacher.php');
            $this->view->schoolClasses = getMyClasses($this->getRegister()->getUser()->getUsername());
            $this->view->showPage();
        }

        public function getClass(){
            $classID = $this->getRegister()->getUrlElements()[2];
            if(!is_numeric($classID)) return;

            $this->view->setViewPath('teacher/teacherClass.php');
            $this->view->pupils = getClassPupils($classID);
            $this->view->showStrippedPage();
        }

//        private function showClass($id){
//            //if(!is_numeric($id)) return $this->index();
//
//            if($id === 'NaN'){ return $this->index();}
//
//            $schoolClasses = getMyClasses($this->getRegister()->getUser());
//            $selectedSchoolClass = getClass($id);
//            $pupils = getPupils($id);
//            $subjects = getClassSubjects($id);
//            $allSubjects = getAllSubjects();
//            include $this->getRegister()->getRoot().'/app/views/teacher/add_homework_view_1.php';
//
//            $this->showFullHeader();
//            include $this->getRegister()->getRoot().'/app/views/teacher/teacher.php';
//            $this->showFooter();
//        }
//
//        private function createUsers($id){
//            if(!is_numeric($id)) return $this->index();
//
//            createUsers($id);
//            $this->showClass($id);
//        }
//
//        private function addSubject($id){
//            if(!is_numeric($id)) return $this->index();
//
//            doAddSubject($id);
//            $this->showClass($id);
//        }
//
        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user) || !$user->isTeacher()){
                header("Location: /login");
                exit;
            }
        }
//
//        private function getClasses () {
//            return doGetClasses();
//        }

    }