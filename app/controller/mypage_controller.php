<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 15:06
 */

    class mypageController extends superController{

        public function __construct ($register) {
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/mypage.php';
            $this->routeAction();
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user)){
                header("Location: /login");
                exit;
            }
        }

        protected function routeAction() {
            $classId = $this->getRegister()->getUser()->getClassID();
            $this->index($classId);
        }

        private function getHomework ($classId) {
            return $this->doGetHomework($classId);
        }

        private function index($id){
            if(!is_numeric($id)){
                header("Location: /");
                exit;
            }
            $this->showFullHeader();
            $homeworkList = $this->getHomework($id);
            include $this->getRegister()->getRoot().'/app/views/mypage_view.php';
            $this->showFooter();
        }

}