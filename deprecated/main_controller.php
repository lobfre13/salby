<?php
    class mainDController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->getRegister()->getRoot().'/app/model/lobjects.php';
            include $this->getRegister()->getRoot().'/app/model/game.php';
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user)){
                header("Location: /login");
                exit;
            }
        }

        public function index($gameHTML = null){
            $this->view->setViewPath('main.php');
            $this->view->subjects = getUserSubjects($this->getRegister()->getUser());;
            $this->view->subjectCategories = getSubjectCategories($this->view->subjects);;
            $this->view->categoryContents = getCategoryContents($this->view->subjectCategories);;
            $this->view->gameHTML = $gameHTML;
            $this->view->showPage();

        }

        public function gameLink($gameHTML = null){
            $urlElements = $this->getRegister()->getUrlElements();
            if(isset($urlElements[2]) and is_numeric($urlElements[2])) $gameHTML = $this->loadGame($urlElements[2]);
            $this->index($gameHTML);
        }

        public function showGame(){
            $id = $this->getRegister()->getUrlElements()[2];
            echo $this->loadGame($id);
        }

        public function updateFavourite() {
            $url = $this->getRegister()->getUrlElements();
            $lObjectId = $url[2];
            doUpdateFavourite($this->getRegister()->getUser()->getUsername(), $lObjectId);
            echo doCheckIfFavouriteExist($this->getRegister()->getUser()->getUsername(), $lObjectId);
        }

        //Flytt ut til modellen?
        private function loadGame($id){
            $lobject = getLObject($id);
            if(empty($lobject)) return null;
            $username = $this->getRegister()->getUser()->getUsername();
            if(!doCheckIfFavouriteExist($username, $id)){
                $favimgurl = "/public/img/favorittericon1.png";
            }
            else {
                $favimgurl = "/public/img/favorittericon2.png";
            }

            ob_start();
            include $this->getRegister()->getRoot()."/app/views/game_view.php";
            $gameHTML = ob_get_clean();
            return $gameHTML;
        }

    }