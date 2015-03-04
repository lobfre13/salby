<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 15:06
 */

    class mypageController extends superController{

        //Fields
        private $homeworkList;

        //Constructor
        public function __construct ($register) {
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/mypage.php';
            $this->routeAction();
        }

        //Operations
        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user)){
                header("Location: /login");
                exit;
            }
        }

        public function getHomeworkList() {
            return $this->homeworkList;
        }

        protected function routeAction() {
            $classId = $this->getRegister()->getUser()->getClassID();
            if (isset($_POST['lObjectId'])) {
                if($this->getRegister()->getRequestMethod() == 'POST') {
                    $this->removeFavourite($this->getRegister()->getUser()->getUsername(), $_POST['lObjectId']);
                }
            }
            $this->index($classId);
        }

        private function getHomework ($classId) {
            return doGetHomework($classId);
        }

        private function getClass ($classId) {
            return doGetClass($classId);
        }

        private function getFavourites ($username) {
            return doGetFavourites($username);
        }

        private function getSubject ($classId) {
            return doGetSubject($classId);
        }

        private function removeFavourite ($username, $lObjectId) {
            include $this->getRegister()->getRoot().'/app/model/game.php';
            doRemoveFavourite($username, $lObjectId);
        }

        private function index($id){
            if(!is_numeric($id)){
                header("Location: /");
                exit;
            }
            $this->showFullHeader();

            $username = $this->getRegister()->getUser()->getUsername();

            $studentFullName = doGetStudentFullName($username);
            $homeworkSubjects = $this->getSubject($id);
            $imgUrls = doGetLearninObjectUrl($id);

            $weeknumber = doGetWeekNumber();
            $schoolClass = $this->getClass($id);
            $homeworkList = $this->getHomework($id);
            $favouriteList = $this->getFavourites($username);
            include $this->getRegister()->getRoot().'/app/views/mypage_view.php';
            $this->showFooter();
        }

}