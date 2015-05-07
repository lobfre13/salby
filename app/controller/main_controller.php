<?php
    class MainController extends SuperController{

        public function __construct($register){
            parent::__construct($register);
            include $this->root.'/app/model/main.php';
            include $this->root.'/app/model/webutility.php';
            include $this->root.'/app/model/favourites.php';
        }

        protected function checkUserAccess(){
            $user = $this->user;
            if(!isset($user)){
                header("Location: /login");
                exit;
            }
        }

        public function index(){
            $this->view->classLevel = getClassLevel($this->user->classID);
            $this->loadDefaultView($this->view->classLevel);
            $this->view->showPage();
        }

        public function subject(){
            $url = array_filter($this->urlElements);
            $url = deSlugify($url);
            if(count($url) < 3 || !validPath($url)) return $this->index();


            $this->view->classLevel = substr($url[2], 0, 1);
            $this->loadDefaultView($this->view->classLevel);
            $this->view->filePathURLS = array_merge($this->view->filePathURLS, getFilePathURLS($url));
            $this->view->urlStr = slugify('/' . join('/', $url) . '/');


            if(count($url) > 3){
                $this->view->subjectsHTMLClass = 'subjectsToggle';
                $this->view->subjects = manageSubjectState($this->view->subjects, $url[3], false);
            }
            if($this->subjectContentRequested($url)) $this->loadSubjectContent($this->view->classLevel, $url[3]);
            else $this->loadCategoryOrGameContent(end($url));

            $this->view->showPage();
        }

        public function updateFavourite() {
            updateFavourite($this->user->username, $_GET['id'], $_GET['url']);
        }

        private function loadCategoryOrGameContent($requestedObject){
            $this->view->categoryContent = getCategoryContentFromName($requestedObject);
            if(arrayEmpty($this->view->categoryContent)) $this->view->gameHTML = $this->loadGame($requestedObject);
        }

        private function loadSubjectContent($classLevel, $subjectName){
            $subject = getSubject($classLevel, $subjectName);
            $this->view->categoryContent = getSubjectCategories($subject['id']);
        }

        private function subjectContentRequested($url){
            return (count($url) == 4);
        }

        private function loadDefaultView($classLevel){
            $this->view->setViewPath('main.php');
            $this->view->subjects = getSubjects($classLevel);
            $this->view->subjects = manageSubjectState($this->view->subjects, null, true);
            $this->view->homeworkCount = getHomeworkCount($this->user->username);
            $this->view->categoryContent = [];
            $this->view->filePathURLS = [];
        }

        private function loadGame($lobject){
            $lobject = getLObject($lobject);
            if(empty($lobject)) return null;
            $username = $this->user->username;
            $isFavourite = favouriteExists($username, $lobject['id']);

            ob_start();
            include $this->root."/app/views/game_view.php";
            $gameHTML = ob_get_clean();
            return $gameHTML;
        }
    }