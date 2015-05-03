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
            include $this->root.'/app/model/mypage.php';
            include $this->root.'/app/model/favourites.php';
            include $this->root.'/app/model/main.php';
            include $this->root.'/app/model/webutility.php';
        }

        protected function checkUserAccess(){
            $user = $this->user;
            if(!isset($user)){
                header("Location: /login");
                exit;
            } else if ($user->isTeacher()) {
                header("Location: /teacher/teacherPersonalPage");
                exit;
            } else if ($user->isAdmin()) {
                header("Location: /admin/adminPersonalPage");
                exit;
            } else if ($user->isSchool()) {
                header("Location: /school/schoolPersonalPage");
                exit;
            }
        }

        public function removeFavourite(){
            $username = $this->user->username;
            $lObjectId = $_POST['lObjectId'];
            removeFavourite($username, $lObjectId);
            $this->index();
        }

        public function updateHomework(){
            $username = $this->user->username;
            $homeworkid = $this->urlElements[2];
            updateHomeworkStatus($username, $homeworkid);
        }

        public function index(){
            $id = $this->user->classID;
            $username = $this->user->username;
            if(!is_numeric($id)){
                header("Location: /");
                exit;
            }

            $this->view->setViewPath('mypage_view.php');

            $this->view->classLevel = getClassLevel($this->user->classID);
            $this->view->homeworkSubjects = getHomeworkSubjects($id, $username);
            $this->view->favouriteList = getUserFavourites($username);
            $this->view->showPage();
        }

}