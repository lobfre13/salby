<?php
    class mainController extends superController{


        public function __construct($register){
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/lobjects.php';
            include $this->getRegister()->getRoot().'/app/model/game.php';
            $this->routeAction();
        }

        protected function routeAction(){
            $url = $this->getRegister()->getUrlElements();
            switch($this->getRegister()->getRequestMethod()){
                case 'GET':
                    if(isset($url[2]))
                    $this->loadGame();
                    else
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

        private function loadGame(){

            $url = $this->getRegister()->getUrlElements();
            switch($url[2]){
                case 1:
                    $lobject = getLObject(1);
                    ob_start();
                    echo 'lol';
                    include $this->getRegister()->getRoot()."/app/views/game_view.php";
                    $a = ob_get_clean();

                    $subjects = [];

                    $subjectCategories = [];
                    $categoryContents = [];

                    $this->showFullHeader();
                    include $this->getRegister()->getRoot().'/app/views/main.php';
                    $this->showFooter();
                    break;
                case 2:
                    break;
                case 3:
                    break;
                case 4:
                    break;
            }
        }


    }