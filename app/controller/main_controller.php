<?php
    class mainController extends superController{


        public function __construct($register){
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/lobjects.php';
            $this->routeAction();
        }

        protected function routeAction(){
            switch($this->getRegister()->getRequestMethod()){
                case 'GET':
                    $this->index();
                    break;
                case 'POST':
                    break;
            }
        }

        private function index(){
            $this->gotoStartPage();

            $urlElements = $this->getRegister()->getUrlElements();
            $subjects = getUserSubjects($this->getRegister()->getUser());

            $subjectCategories = getSubjectCategories($subjects);
            $categoryContents = getCategoryContents($subjectCategories);

            $filePath = doGetPath();

            $this->showFullHeader();
            include $this->getRegister()->getRoot().'/app/views/main.php';
            $this->showFooter();
        }

        private function gotoStartPage(){
            if($this->getRegister()->getUser()->isAdmin()){
                header("Location: /admin");
                exit;
            }
            else if($this->getRegister()->getUser()->isTeacher()){
                header("Location: /teacher");
                exit;
            }
            else if($this->getRegister()->getUser()->isSchool()){
                header("Location: /schooladmin");
                exit;
            }
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user)){
                header("Location: /login");
                exit;
            }
        }


    }