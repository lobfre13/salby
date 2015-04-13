<?php
    class mainController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->getRegister()->getRoot().'/app/model/main.php';
            include $this->getRegister()->getRoot().'/app/model/webutility.php';
            include $this->getRegister()->getRoot().'/app/model/game.php';
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user)){
                header("Location: /login");
                exit;
            }
        }

        public function index(){
            $this->loadDefaultView();
            $this->view->showPage();
        }

        public function subject(){
            $this->loadDefaultView();
            $url = $this->getRegister()->getUrlElements();

            $this->view->gameHTML = null;
            $this->view->url = '/' . join('/', $url) . '/';

            if($this->subjectContentRequested($url)) $this->loadSubjetContent($url[2], $url[3]);
            else $this->loadCategoryOrGameContent($url);

            $this->view->showPage();
        }

        //Flytte private metoder til modell?
        private function loadCategoryOrGameContent($url){
            $category = getCategory(deSlugify(end($url)));
            if(empty($category)){ //if empty == not a category, which means its a lObject
                $this->view->gameHTML = $this->loadGame(getLObject(deSlugify(end($url))));
            }
            else{
                $this->view->categoryContent = array_merge($this->view->categoryContent, getLObjects($category['id']));
                $this->view->categoryContent = array_merge($this->view->categoryContent, getSubCategories($category['id']));
            }
        }

        private function loadSubjetContent($classLevel, $subjectName){
            $subject = getSubject($classLevel, $subjectName);
            $this->view->categoryContent = array_merge($this->view->categoryContent, getSubjectCategories($subject['id']));
        }

        private function subjectContentRequested($url){
            return (!(count($url) > 4));
        }

        private function loadDefaultView(){
            $this->view->setViewPath('main.php');
            $this->view->classLevel = getClassLevel($this->getRegister()->getUser()->getClassID());
            $this->view->subjects = getUserSubjects($this->getRegister()->getUser());
            $this->view->categoryContent = [];
        }

        //Flytt ut til modellen?
        private function loadGame($lobject){
            if(empty($lobject)) return null;
            $username = $this->getRegister()->getUser()->getUsername();
            if(!doCheckIfFavouriteExist($username, $lobject['id'])){
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