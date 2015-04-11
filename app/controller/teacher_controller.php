<?php
    class teacherController extends superController{

        public function __construct($register){
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/teacher.php';
//            $this->routeAction();
        }

        protected function routeAction(){
            $urlElements = $this->getRegister()->getUrlElements();
            switch($this->getRegister()->getRequestMethod()){
                case 'GET':
                    if(isset($urlElements[1]))
                        $this->showClass($urlElements[1]);
                    else
                        $this->showClass('NaN');
                    break;
                case 'POST':
                    if (isset($_POST['addGame'])) {
                        $listOfClasses = $this->getClasses();
                        include $this->getRegister()->getRoot() . '/app/views/teacher/add_homework_view_1.php';
                    } else if (isset($urlElements[1])){
                        if(isset($_POST['subjectid']))
                            $this->addSubject($urlElements[1]);
                        else
                            $this->createUsers($urlElements[1]);
                    } else if (isset($_POST['continue'])) {
                        include $this->getRegister()->getRoot() . '/app/views/teacher/add_homework_view_2.php';
                    } else if (isset($_POST['continueTo3'])) {
                        include $this->getRegister()->getRoot() . '/app/views/teacher/add_homework_view_3.php';
                    } else if (isset($_POST['backTo1'])) {
                        include $this->getRegister()->getRoot() . '/app/views/teacher/add_homework_view_1.php';
                    } else if (isset($_POST['backTo2'])) {
                        include $this->getRegister()->getRoot() . '/app/views/teacher/add_homework_view_2.php';
                    } else if (isset($_POST['approve'])) {
                        echo 'Det fungerer';
                    }
                    break;
            }
        }

        public function index(){
            $this->view->setViewPath('teacher/teacher.php');
            $this->view->schoolClasses = getMyClasses($this->getRegister()->getUser());
            $this->view->showPage();
        }

        private function showClass($id){
            //if(!is_numeric($id)) return $this->index();

            if($id === 'NaN'){ return $this->index();}

            $schoolClasses = getMyClasses($this->getRegister()->getUser());
            $selectedSchoolClass = getClass($id);
            $pupils = getPupils($id);
            $subjects = getClassSubjects($id);
            $allSubjects = getAllSubjects();
            include $this->getRegister()->getRoot().'/app/views/teacher/add_homework_view_1.php';

            $this->showFullHeader();
            include $this->getRegister()->getRoot().'/app/views/teacher/teacher.php';
            $this->showFooter();
        }

        private function createUsers($id){
            if(!is_numeric($id)) return $this->index();

            createUsers($id);
            $this->showClass($id);
        }

        private function addSubject($id){
            if(!is_numeric($id)) return $this->index();

            doAddSubject($id);
            $this->showClass($id);
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user) || !$user->isTeacher()){
                header("Location: /login");
                exit;
            }
        }

        private function getClasses () {
            return doGetClasses();
        }

    }