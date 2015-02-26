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
        }

        private function getHomework () {
            return $this->doGetHomework($this->getRegister()->getUser());
        }

        private function index($id){
            if(!is_numeric($id)){
                header("Location: /");
                exit;
            }
            $this->showFullHeader();
            $homeworkList = $this->getHomework();
            foreach ($homeworkList as $homeworkItem) {
                echo "<li>".$homeworkItem."</li>";
            }
            include $this->getRegister()->getRoot().'/app/views/mypage_view.php';
            $this->showFooter();
        }

}