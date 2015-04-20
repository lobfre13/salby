<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 15:06
 */

    class mypageController extends superController{

        public function __construct($register) {
            parent::__construct($register);
            include $this->getRegister()->getRoot().'/app/model/mypage.php';
            include $this->getRegister()->getRoot().'/app/model/favourites.php';
            include $this->getRegister()->getRoot().'/app/model/main.php';
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user)){
                header("Location: /login");
                exit;
            }
        }

        public function removeFavourite(){
            include $this->getRegister()->getRoot().'/app/model/game.php';
            $username = $this->getRegister()->getUser()->getUsername();
            $lObjectId = $_POST['lObjectId'];
            doRemoveFavourite($username, $lObjectId);
            $this->index();
        }

        public function index(){
            $id = $this->getRegister()->getUser()->getClassID();
            $username = $this->getRegister()->getUser()->getUsername();
            if(!is_numeric($id)){
                header("Location: /");
                exit;
            }

            $this->view->setViewPath('mypage_view.php');

            $this->view->classLevel = getClassLevel($this->getRegister()->getUser()->getClassID());
            $this->view->homeworkSubjects = getHomeworkSubjects($id);
            $this->view->weeknumber = getWeekNumber();
            $this->view->favouriteList = getUserFavourites($username);
            $this->view->showPage();


//          $this->view->studentFullName = getStudentFullName($username);
//          $this->view->imgUrls = getLObjectUrl($id);
//          $this->view->homeworkList = getHomework($id);
        }

}