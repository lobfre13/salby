<?php
    class adminController extends superController{

        //Constructor
        public function __construct($register){
            parent::__construct($register);
            include $this->root.'/app/model/admin.php';
            include $this->root.'/app/model/webutility.php';
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
            $this->view->schools = searchSchools($_POST['searchBoxSchools']);
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

        public function actuallyAddSchool () {
            addSchool($_POST['skolenavn'], $_POST['fylke'], $_POST['kommune']);
            header("Location: /admin/administrateSchools");
            exit;
        }

        public function actuallyAddSubject () {
            addSubject($_POST['fagnavn'], $_POST['klasseTrinn'], $_POST['fileToUpload']);

        }

        public function actuallyAddCategory () {
            addCategory($_POST['kategori'], $_POST['bildeToUpload'], $_POST['tilhørendeFag'], $_POST['klasseTrinn']);
            $this->administrateCategories();
        }

        public function actuallyAddLearningObject () {
            addLearningObject($_POST['lOnavn'], $_POST['lOIconToUpload'], $_POST['lOToUpload']);
            header("Location: /admin/administrateLearningobjects");
            exit;
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
        public function doDeleteSchool () {
            deleteSchool($this->urlElements[2]);
        }

        public function doDeleteSubject () {
            deleteSubject($this->urlElements[2]);
        }

        public function doDeleteCategory () {
            deleteCategory($this->urlElements[2]);
        }

        public function doDeleteLearningObject () {
            deleteLearningObject($this->urlElements[2]);
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
