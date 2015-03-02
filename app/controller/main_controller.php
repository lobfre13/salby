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

            //WTF brainfuck...
            foreach($subjects as $subject){
                $subjectCategories []= [$subject['id'], getUserCategories($subject['id'])];
            }

            foreach($subjectCategories as $categories){
                foreach($categories[1] as $category){
                    $categoryContents []= [$category['id'], getAllLobjects($category['id']), getSubCategories($category['id'])];
                }
            }
            foreach($categoryContents as &$content){
                foreach($content[2] as $subCat){
                    $categoryContents []= [$subCat['id'], getAllLobjects($subCat['id']), getSubCategories($subCat['id'])];
                }
            }


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