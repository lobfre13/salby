<?php
    class adminController extends superController{

        //Constructor
        public function __construct($register){
            parent::__construct($register);
            include $this->root.'/app/model/admin.php';
        }

        //Index-operation
        public function index(){
            $this->view->setViewPath('admin/admin.php');
            $this->view->subjects = getSubjects();
            $this->view->categories = getAllCategories();
            $this->view->showPage();
        }

        //Sub-page-operations
        public function administrateSchools () {
            $this->view->setViewPath('admin/administrateSchools.php');
            if (isset($_POST['searchBoxSchools'])) $this->view->schools = searchSchools($_POST['searchBoxSchools']);
            else $this->view->schools = getSchools();
            $this->view->showPage();
        }

        public function administrateSubjects () {
            $this->view->setViewPath('admin/administrateSubjects.php');
            if (isset($_POST['searchBoxSubjects'])) $this->view->subjects = searchSubjects($_POST['searchBoxSubjects']);
            else $this->view->subjects = getSubjects();
            $this->view->showPage();
        }

        public function administrateCategories () {
            $this->view->setViewPath('admin/administrateCategories.php');
            if (isset($_POST['searchBoxCategories'])) $this->view->categories = searchCategories($_POST['searchBoxCategories']);
            else $this->view->categories = getAllCategories();
            $this->view->showPage();
        }

        public function administrateLearningobjects () {
            $this->view->setViewPath('admin/administrateLearningobjects.php');
            if (isset($_POST['searchBoxLearningObjects'])) $this->view->learningObjects = searchLearningObjects($_POST['searchBoxLearningObjects']);
            else $this->view->learningObjects = getAllLearningObjects();
            $this->view->showPage();
        }

        //Search-operations
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

        //Add-operations
        public function addSchool()
        {
            $this->view->setViewPath('admin/CRUD/addSchool.php');
            $this->view->schools = getSchools();
            $this->view->showStrippedPage();
        }

        public function addCategories()
        {
            $this->view->setViewPath('admin/CRUD/addCategories.php');
            $this->view->categories = getAllCategories();
            $this->view->showStrippedPage();
        }

        public function doAddSchool () {
            $this->view->setViewPath('admin/CRUD/addSchool.php');
            $this->view->showStrippedPage();
        }

        public function addSubject(){
            $this->view->setViewPath('admin/CRUD/addSubjects.php');
            $this->view->showStrippedPage();
        }

        public function addLearningObject () {
            $this->view->setViewPath('admin/CRUD/addLearningObjects.php');
            $this->view->showStrippedPage();
        }

        //Delete-operations
        public function doDeleteSchool ($schoolName) {
            $this->view->setViewPath('admin/administrateSchools.php');
            deleteSchool($schoolName);
            $this->view->showPage();
        }

        public function doDeleteSubject ($subjectName) {
            $this->view->setViewPath('admin/administrateSubjects.php');
            deleteSubject($subjectName);
            $this->view->showPage();
        }

        public function doDeleteCategory ($categoryName) {
            $this->view->setViewPath('admin/administrateCategories.php');
            deleteCategory($categoryName);
            $this->view->showPage();
        }

        public function doDeleteLearningObject ($learningObjectName) {
            $this->view->setViewPath('admin/administrateLearningobjects.php');
            deleteLearningObject($learningObjectName);
            $this->view->showPage();
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
