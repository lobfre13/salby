<?php
    class mainController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->getRegister()->getRoot().'/app/model/main.php';
            include $this->getRegister()->getRoot().'/app/model/webutility.php';
            include $this->getRegister()->getRoot().'/app/model/favourites.php';
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
            $this->view->classLevel = getClassLevel($this->getRegister()->getUser()->getClassID());
            $this->view->showPage();
        }

        public function subject(){
            $url = array_filter($this->getRegister()->getUrlElements());
            if(count($url) < 3) return $this->index();
            $this->loadDefaultView();
            $this->view->classLevel = $url[2];
            $this->view->filePathURLS = array_merge($this->view->filePathURLS, getFilePathURLS($url));

            $this->view->gameHTML = null;
            $this->view->url = $url;
            if(count($url) > 3) $this->view->selectedSubject = $url[3];
            $this->view->urlStr = '/' . join('/', $url) . '/';

            if($this->subjectContentRequested($url)) $this->loadSubjectContent($url[2], $url[3]);
            else $this->loadCategoryOrGameContent($url);

            $this->view->showPage();
        }

        public function updateFavourite() {
            doUpdateFavourite($this->getRegister()->getUser()->getUsername(), $_GET['id'], $_GET['url']);
            echo favouriteExists($this->getRegister()->getUser()->getUsername(), $_GET['id']);
        }

        //Flytte private metoder til modell somehow?
        private function loadCategoryOrGameContent($url){
            $requestedObject = deSlugify(end($url));
            $category = getCategory($requestedObject);
            if(empty($category)){ //if empty == not a category, which means its a lObject
                $this->view->gameHTML = $this->loadGame($requestedObject);
            }
            else{
                $this->view->categoryContent = array_merge($this->view->categoryContent, getLObjects($category['id']));
                $this->view->categoryContent = array_merge($this->view->categoryContent, getSubCategories($category['id']));
            }
        }

        private function loadSubjectContent($classLevel, $subjectName){
            $subject = getSubject($classLevel, $subjectName);
            $this->view->categoryContent = array_merge($this->view->categoryContent, getSubjectCategories($subject['id']));
        }

        private function subjectContentRequested($url){
            return (count($url) == 4);
        }

        private function loadDefaultView(){
            $this->view->setViewPath('main.php');
            $this->view->subjects = getUserSubjects($this->getRegister()->getUser());
            $this->view->categoryContent = [];
            $this->view->selectedSubject = null;
            $this->view->filePathURLS = [['/main/', 'Forsiden']];
        }

        //Flytt ut til modellen?
        private function loadGame($lobject){
            $lobject = getLObject($lobject);
            if(empty($lobject)) return null;
            $username = $this->getRegister()->getUser()->getUsername();
            $favimgurl = getFavouriteIcon($lobject['id'], $username);

            ob_start();
            include $this->getRegister()->getRoot()."/app/views/game_view.php";
            $gameHTML = ob_get_clean();
            return $gameHTML;
        }
    }