<?php
    class adminController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->getRegister()->getRoot().'/app/model/admin.php';
        }

        public function index(){
            $this->view->setViewPath('admin/admin.php');
            $this->view->subjects = getSubjects();
            $this->view->categories = getAllCategories();
            $this->view->showPage();
        }

        public function administrateSchools () {
            $this->view->setViewPath('admin/administrateSchools.php');
            $this->view->schools = getSchools();
            $this->view->showPage();
        }

        public function administrateSubjects () {
            $this->view->setViewPath('admin/administrateSubjects.php');
            $this->view->subjects = getSubjects();
            $this->view->showPage();
        }

        public function administrateCategories () {
            $this->view->setViewPath('admin/administrateCategories.php');
            $this->view->categories = getAllCategories();
            $this->view->showPage();
        }

        public function doGetSearchResults () {
            $this->view->setViewPath('admin/administrateSchools.php');
            $this->view->schools = searchSchools($_POST['searchBox']);
            $this->view->showPage();
        }

        private function addSubject(){
            doAddSubject();
            $this->index();
        }

        private function showSubject($id){
            if(!is_numeric($id)) return $this->index();

            $subject = getSubject($id);
            $categories = getCategories($subject['id']);

            $this->showFullHeader();
            include $this->getRegister()->getRoot().'/app/views/admin/subject.php';
            $this->showFooter();

        }

        private function addCategory($id){
            if(!is_numeric($id)) return $this->index();

            doAddCategory($id);
            $this->showSubject($id);
        }

        private function addLObject(){
            doAddLObject();
            $this->index();
        }

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user) || !$user->isAdmin()){
                header("Location: /login");
                exit;
            }
        }
    }
