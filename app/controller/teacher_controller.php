<?php
    class teacherController extends superController{

        public function __construct($register){
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/teacher.php';
            $this->routeAction();
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
                    if(isset($urlElements[1])){
                        if(isset($_POST['subjectid']))
                            $this->addSubject($urlElements[1]);
                        else
                            $this->createUsers($urlElements[1]);
                    }
                    break;
            }
        }

        private function index(){
            $schoolClasses = getMyClasses($this->getRegister()->getUser());

            $this->showFullHeader();
            include $this->getRegister()->getRoot().'/app/views/teacher/teacher.php';
            $this->showFooter();
        }

        private function showClass($id){
            //if(!is_numeric($id)) return $this->index();

            if($id === 'NaN'){ return $this->index();}

            $schoolClasses = getMyClasses($this->getRegister()->getUser());
            $selectedSchoolClass = getClass($id);
            $pupils = getPupils($id);
            $subjects = getClassSubjects($id);
            $allSubjects = getAllSubjects();

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


    }