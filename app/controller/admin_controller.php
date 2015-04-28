<?php
    class adminController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->root.'/app/model/admin.php';
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

        public function administrateLearningobjects () {
            $this->view->setViewPath('admin/administrateLearningobjects.php');
            $this->view->learningObjects = getAllLearningObjects();
            $this->view->showPage();
        }

        public function doGetSchoolSearchResults () {
            $this->view->setViewPath('admin/administrateSchools.php');
            $this->view->schools = searchSchools($_POST['searchBoxSchools']);
            $this->view->showPage();
        }

        public function doGetSubjectsSearchResult () {
            $this->view->setViewPath('admin/administrateSubjects.php');
            $this->view->subjects = searchSubjects($_POST['searchBoxSubjects']);
            $this->view->showPage();
        }

        public function doGetCategoriesSearchResult () {
            $this->view->setViewPath('admin/administrateCategories.php');
            $this->view->categories = searchCategories($_POST['searchBoxCategories']);
            $this->view->showPage();
        }

        public function doGetLearningobjectsSearchResult () {
            $this->view->setViewPath('admin/administrateLearningobjects.php');
            $this->view->leaningObjects = searchLearningObjects($_POST['searchBoxLearningObjects']);
            $this->view->showPage();
        }

        public function addSchool()
        {
            $this->view->setViewPath('admin/CRUD/addSchool.php');
            $this->view->schools = getSchools();
            $this->view->showPage();
        }

        public function addCategories()
        {
            $this->view->setViewPath('admin/CRUD/addCategories.php');
            $this->view->categories = getAllCategories();
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
            include $this->root.'/app/views/admin/subject.php';
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
            $user = $this->user;
            if(!isset($user) || !$user->isAdmin()){
                header("Location: /login");
                exit;
            }
        }
    }
