<?php
    class teacherController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->getRegister()->getRoot().'/app/model/teacher.php';
            include $this->getRegister()->getRoot().'/app/model/main.php';
        }

        public function index(){
            $this->view->setViewPath('teacher/teacher.php');
            $this->view->schoolClasses = getMyClasses($this->getRegister()->getUser()->getUsername());
            $this->view->showPage();
        }

        public function getClass(){
            $classID = $this->getRegister()->getUrlElements()[2];
            if(!is_numeric($classID)) return;

            $this->view->setViewPath('teacher/teacherClass.php');
            $this->view->pupils = getClassPupils($classID);
            $this->view->showStrippedPage();
        }

        public function getClassTasks(){
            $classID = $this->getRegister()->getUrlElements()[2];
            if(!is_numeric($classID)) return;

            $this->view->setViewPath('teacher/homework/classTasks.php');
            $this->view->tasks = getClassTasks($classID);
            $this->view->showStrippedPage();
        }

        public function editTask(){
            $taskID = $this->getRegister()->getUrlElements()[2];
            $this->view->setViewPath('teacher/homework/editTask.php');
            $this->view->task = getClassTask($taskID);
            $this->view->showStrippedPage();
        }

        public function updateTask(){
            updateClassTask($_POST['taskid'], $_POST['date']);
            $this->index();
        }

        public function deleteTask(){
            $taskID = $this->getRegister()->getUrlElements()[2];
            deleteClassTask($taskID);
        }

        public function addTask(){
            $this->view->setViewPath('teacher/homework/addTask.php');
            if(isset($_SESSION['chosenTasks'])) $this->view->chosenTasks = $_SESSION['chosenTasks'];
            $this->view->schoolClasses = getMyClasses($this->getRegister()->getUser()->getUsername());
            $this->view->showPage();
        }

        public function getCategories(){
            $subjectID = $this->getRegister()->getUrlElements()[2];
            $this->view->setViewPath('teacher/homework/addTaskCategories.php');
            $this->view->categories = getSubjectCategories($subjectID);
            $this->view->showStrippedPage();
        }

        public function getCategoryContent(){
            $categoryid = $this->getRegister()->getUrlElements()[2];
            $this->view->setViewPath('teacher/homework/addTaskCategoryContent.php');
            $this->view->categoryContent = getCategoryContent($categoryid);
            $this->view->showStrippedPage();
        }

        public function addPendingTask(){
            $taskID = $this->getRegister()->getUrlElements()[2];
            $classSubjectID = $this->getRegister()->getUrlElements()[3];
            $username = $this->getRegister()->getUser()->getUsername();
            addPendingTask($taskID, $username, $classSubjectID);
        }

        public function getPendingTasks(){
            $subjectID = $this->getRegister()->getUrlElements()[2];
            $username = $this->getRegister()->getUser()->getUsername();
            $this->view->setViewPath('teacher/homework/pendingTasks.php');
            $this->view->pendingTasks = getPendingTasks($subjectID, $username);
            $this->view->showStrippedPage();

        }

        public function choosePupils(){
            $classid = $this->getRegister()->getUrlElements()[2];
            $username = $this->getRegister()->getUser()->getUsername();
            $this->view->setViewPath('/teacher/homework/choosePupils.php');
            $this->view->classid = $classid;
            $this->view->pupils = getPupils($classid);
            $this->view->pendingTasks = getPendingTasks($classid, $username);
            $this->view->showPage();
        }

        public function acceptTasks(){
            $pupilUsernames = $_POST['pupils'];
            $classid = $_POST['classid'];
            $username = $this->getRegister()->getUser()->getUsername();
            $this->view->setViewPath('teacher/homework/acceptTasks.php');
            $this->view->pupils = getPupilsFromUsername($pupilUsernames);
            $this->view->classid = $classid;
            $this->view->pendingTasks = getPendingTasks($classid, $username);
            $this->view->showPage();
        }

        public function doAddTasks(){
            $pupilUsernames = $_POST['pupils'];
            $classid = $_POST['classid'];
            $username = $this->getRegister()->getUser()->getUsername();
            $pendingTasks = getPendingTasks($classid, $username);
            addHomework($pendingTasks, $pupilUsernames, $classid);
            removePendingTasks($pendingTasks[0]['pendinghomeworkclassid']);
            $this->index();
        }

//        private function showClass($id){
//            //if(!is_numeric($id)) return $this->index();
//
//            if($id === 'NaN'){ return $this->index();}
//
//            $schoolClasses = getMyClasses($this->getRegister()->getUser());
//            $selectedSchoolClass = getClass($id);
//            $pupils = getPupils($id);
//            $subjects = getClassSubjects($id);
//            $allSubjects = getAllSubjects();
//            include $this->getRegister()->getRoot().'/app/views/teacher/add_homework_view_1.php';
//
//            $this->showFullHeader();
//            include $this->getRegister()->getRoot().'/app/views/teacher/teacher.php';
//            $this->showFooter();
//        }
//
//        private function createUsers($id){
//            if(!is_numeric($id)) return $this->index();
//
//            createUsers($id);
//            $this->showClass($id);
//        }
//
//        private function addSubject($id){
//            if(!is_numeric($id)) return $this->index();
//
//            doAddSubject($id);
//            $this->showClass($id);
//        }
//
        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user) || !$user->isTeacher()){
                header("Location: /login");
                exit;
            }
        }
//
//        private function getClasses () {
//            return doGetClasses();
//        }

    }