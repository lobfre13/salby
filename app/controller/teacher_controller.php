<?php
    class teacherController extends superController{

        public function __construct($register){
            parent::__construct($register);
            include $this->root.'/app/model/teacher.php';
            include $this->root.'/app/model/main.php';
            include $this->root.'/app/model/webutility.php';
        }

        public function index(){
            $this->view->setViewPath('teacher/teacher.php');
            $this->view->schoolClasses = getMyClasses($this->user->username);
            $this->view->showPage();
        }

        public function getClass(){
            $classID = $this->urlElements[2];
            if(!is_numeric($classID)) return;

            $this->view->setViewPath('teacher/homework/partialviews/teacherClass.php');
//            $this->view->pupils = getClassPupils($classID);
            $this->view->pupils = combinePupilNameAndProgress($classID);
            $this->view->showStrippedPage();
        }

        public function getClassTasks(){
            $classID = $this->urlElements[2];
            if(!is_numeric($classID)) return;

            $this->view->setViewPath('teacher/homework/partialviews/classTasks.php');
            $this->view->tasks = getClassTasks($classID);
            $this->view->showStrippedPage();
        }

        public function editTask(){
            $taskID = $this->urlElements[2];
            $this->view->setViewPath('teacher/homework/partialviews/editTask.php');
            $this->view->task = getClassTask($taskID);
            $this->view->showStrippedPage();
        }

        public function updateTask(){
            updateClassTask($_POST['taskid'], $_POST['date']);
            $this->index();
        }

        public function deleteTask(){
            $taskID = $this->urlElements[2];
            deleteClassTask($taskID);
        }

        public function addTask(){
            $this->view->setViewPath('teacher/homework/addTask.php');
            if(isset($_SESSION['chosenTasks'])) $this->view->chosenTasks = $_SESSION['chosenTasks'];
            $this->view->schoolClasses = getMyClasses($this->user->username);
            $this->view->showPage();
        }

        public function getCategories(){
            $subjectID = $this->urlElements[2];
            $this->view->setViewPath('teacher/homework/partialviews/addTaskCategories.php');
            $this->view->categories = getSubjectCategories($subjectID);
            $this->view->showStrippedPage();
        }

        public function getCategoryContent(){
            $categoryid = $this->urlElements[2];
            $this->view->setViewPath('teacher/homework/partialviews/addTaskCategoryContent.php');
            $this->view->categoryContent = getCategoryContent($categoryid);
            $this->view->showStrippedPage();
        }

        public function addPendingTask(){
            $taskID = $this->urlElements[2];
            $classSubjectID = $this->urlElements[3];
            $username = $this->user->username;
            addPendingTask($taskID, $username, $classSubjectID);
        }

        public function getPendingTasks(){
            $subjectID = $this->urlElements[2];
            $username = $this->user->username;
            $this->view->setViewPath('teacher/homework/partialviews/pendingTasks.php');
            $this->view->pendingTasks = getPendingTasks($subjectID, $username);
            $this->view->showStrippedPage();

        }

        public function choosePupils(){
            $classid = $this->urlElements[2];
            $username = $this->user->username;
            $this->view->setViewPath('/teacher/homework/choosePupils.php');
            $this->view->classid = $classid;
            $this->view->pupils = getPupils($classid);
//            $this->view->pupils = combinePupilNameAndProgress($classid);
//            $this->view->homeworkProgress = calculateHomeworkProgressForPupil($username);
            $this->view->pendingTasks = getPendingTasks($classid, $username);
            if(arrayEmpty($this->view->pendingTasks)) return $this->addTask();
            $this->view->showPage();
        }

        public function acceptTasks(){
            if(!isset($_POST['pupils'])){
                return $this->addTask();
            }
            $pupilUsernames = $_POST['pupils'];
            $classid = $_POST['classid'];
            $username = $this->user->username;
            $this->view->setViewPath('teacher/homework/acceptTasks.php');
            $this->view->pupils = getPupilsFromUsername($pupilUsernames);
            $this->view->classid = $classid;
            $this->view->pendingTasks = getPendingTasks($classid, $username);
            $this->view->showPage();
        }

        public function doAddTasks(){
            $pupilUsernames = $_POST['pupils'];
            $classid = $_POST['classid'];
            $username = $this->user->username;
            $pendingTasks = getPendingTasks($classid, $username);
            addHomework($pendingTasks, $pupilUsernames, $classid);
            removePendingTasks($pendingTasks[0]['pendinghomeworkclassid']);
            $this->index();
        }

        public function pupilSettings () {
            $this->view->setViewPath('teacher/pupilsettings.php');
            $this->view->classes = getMainTeacherClasses($this->user->username);
            $this->view->showPage();
        }

        public function pupilsFromClass () {
            $this->view->setViewPath('teacher/pupilSettingsTable.php');
            $this->view->pupils = getPupilsByClassId($this->urlElements[2]);
            $this->view->showStrippedPage();
        }

        public function teacherPersonalPage () {
            $this->view->setViewPath('teacher/teacherPersonalPage.php');
            $this->view->teacher = $this->user->username;
            $this->view->showPage();
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
            $user = $this->user;
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