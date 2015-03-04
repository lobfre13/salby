<?php
class sectionController extends superController{


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
                if(isset($url[1]) and $url[1] === 'ajax'){
                    echo $this->loadGame($url[2]);
                }
                else $this->index();
                break;
            case 'POST':
                if (isset($url[2])) $this->updateFavourite($url[2]);
                break;
        }
    }

    private function index(){
        $urlElements = $this->getRegister()->getUrlElements();

        $subjects = getUserSubjects($this->getRegister()->getUser());
        $subjectCategories = getSubjectCategories($subjects);
        $categoryContents = getCategoryContents($subjectCategories);
        $gameHTML = null;
        if(isset($urlElements[2]) and is_numeric($urlElements[2])) $gameHTML = $this->loadGame($urlElements[2]);

        $this->showFullHeader();
        include $this->getRegister()->getRoot().'/app/views/main.php';
        $this->showFooter();
    }

    protected function checkUserAccess(){
        $user = $this->getRegister()->getUser();
        if(!isset($user)){
            header("Location: /login");
            exit;
        }
    }

    private function loadGame($id){
        $lobject = getLObject($id);
        if(empty($lobject)) return null;

        ob_start();
        include $this->getRegister()->getRoot()."/app/views/game_view.php";
        $gameHTML = ob_get_clean();
        return $gameHTML;
    }

    private function updateFavourite($lObjectId) {
        doUpdateFavourite($this->getRegister()->getUser()->getUsername(), $lObjectId);
    }

}