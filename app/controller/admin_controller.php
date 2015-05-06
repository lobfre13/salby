<?php
    class adminController extends superController{

        //Constructor
        public function __construct($register){
            parent::__construct($register);
            include $this->root.'/app/model/admin.php';
            include $this->root.'/app/model/main.php';
            include $this->root.'/app/model/schooladmin.php';
            include $this->root.'/app/model/webutility.php';
            include $this->root.'/app/model/teacher.php';
        }

        //Index-operation
        public function index(){
            $this->administrateSchools ();
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
            else $this->view->subjects = getAllSubjects();
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
            $fileName = picUpload($this->root);
            if ($fileName) {
                addNewSubject($_POST['fagnavn'], $_POST['klasseTrinn'], $fileName);
            }
            header("Location: /admin/administrateSubjects");
            exit;
        }

        public function actuallyAddCategory () {
            $fileName = picUpload($this->root);
            if ($fileName) {
                addNewCategory($_POST['kategori'], $fileName);
            }
            header("Location: /admin/administrateCategories");
            exit;
        }

        public function actuallyAddLearningObject () {
            addLearningObject($_POST['lOnavn']);
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

        public function deletelObjectRelation(){
            deletelObjectRelation($this->urlElements[2], $this->urlElements[3]);
        }

        public function deleteCategoryRelation(){
            deleteCategoryRelation($this->urlElements[2], $this->urlElements[3]);
        }
        public function deleteParentCategoryRelation(){
            deleteParentCategoryRelation($this->urlElements[2]);
        }


        //Edit Operations
        public function editLearningobjects(){
            $this->view->setViewPath("admin/CRUD/editLearningobjects.php");
            $this->view->lObject = getLObjectFromID($this->urlElements[2]);
            $this->view->lObjectRelations = getlObjectRelation($this->urlElements[2]);
            $this->view->showPage();
        }

        public function loadSubjects(){
            $this->view->setViewPath("admin/PartialViews/subjectOptions.php");
            $this->view->subjects = getSubjects($this->urlElements[2]);
            $this->view->showStrippedPage();
        }

        public function loadCategories(){
            $this->view->setViewPath("admin/PartialViews/categoryOptions.php");
            $this->view->categories = getCategories($this->urlElements[2]);
            if(isset($this->urlElements[3])) $this->view->optionalCategory = "HELLO";
            $this->view->showStrippedPage();
        }

        public function addlObjectRelation(){
            addlObjectRelation($this->urlElements[2], $_POST['category']);
            header("Location: /admin/editLearningobjects/".$this->urlElements[2]);
            exit;
        }

        public function updateLObject(){
            updateLObject($_POST['id'], $_POST['title']);
            header("Location: /admin/editLearningobjects/".$_POST['id']);
            exit;
        }

        public function editCategories(){
            $this->view->setViewPath("admin/CRUD/editCategories.php");
            $category = getCategoryFromID($this->urlElements[2]);
            $this->view->category = $category;
            $this->view->categoryRelations = getCategoryRelations($this->urlElements[2]);
            $this->view->parentCategories = getParentCategories($category['parentid']);
            $this->view->showPage();
        }

//        public function updateCategory(){
//            updateCategory($_POST['id'], $_POST['title'], $_POST['icon']);
//            header("Location: /admin/editCategories/".$_POST['id']);
//            exit;
//        }

        public function addCategoryRelation(){
            addCategoryRelation($this->urlElements[2], $_POST['subject'] , $_POST['category']);
            header("Location: /admin/editCategories/".$this->urlElements[2]);
            exit;
        }

        public function editSubjects(){
            $this->view->setViewPath("admin/CRUD/editSubjects.php");
            $this->view->subject = getSubjectFromID($this->urlElements[2]);
            $this->view->showPage();
        }

        //OPPDATERING MED OPPLASTNING AV BILDER!!!!
        public function updateSubject(){
            $fileName = picUpload($this->root);
            editSubject($_POST['id'], $_POST['title'], $_POST['classlevel'], $fileName);
            header("Location: /admin/editSubjects/".$_POST['id']);
            exit;
        }

        public function updateCategories () {
            $fileName = picUpload($this->root);
            editCategory($_POST['id'], $_POST['title'], $fileName);
            header("Location: /admin/editCategories/".$_POST['id']);
            exit;
        }

        public function editSchools(){
            $this->view->setViewPath("admin/CRUD/editSchools.php");
            $this->view->school = getSchool($this->urlElements[2]);
            $this->view->schoolUsers = getSchoolUsers($this->urlElements[2]);
            $this->view->showPage();
        }

        public function updateSchool(){
            updateSchool($_POST['id'], $_POST['name'],$_POST['fylke'], $_POST['kommune']);
            header("Location: /admin/editSchools/".$_POST['id']);
            exit;
        }

        public function addSchoolUser(){
            addSchoolUser($_POST['schoolid'], $_POST['username'],$_POST['password'], $_POST['email']);
            header("Location: /admin/editSchools/".$_POST['schoolid']);
            exit;
        }

        public function deleteSchoolUser(){
            deleteUser($this->urlElements[2]);
        }

        protected function checkUserAccess(){
            $user = $this->user;
            if(!isset($user) || !$user->isAdmin()){
                header("Location: /login");
                exit;
            }
        }

        public function adminPersonalPage () {
            $this->view->setViewPath('admin/adminPersonalPage.php');
            $this->view->admin = getAdmin($this->user->username);
            $this->view->showPage();
        }

        public function doChangeEmail () {
            changeEmail($this->user->username, $_POST['email']);
            header("Location: /admin/adminPersonalPage");
            exit;
        }

        public function doChangePassword () {
            changePassword($this->user->username, $_POST['currentPassword'], $_POST['newPassword1'], $_POST['newPassword2']);
            header("Location: /admin/adminPersonalPage");
            exit;
        }
    }
