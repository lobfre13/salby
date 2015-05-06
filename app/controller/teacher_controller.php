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
            $classId = $this->urlElements[2];
            if (!is_numeric($classId)) return;

            $this->view->setViewPath('teacher/homework/partialviews/teacherClass.php');
            $this->view->pupils = combinePupilNameAndProgress($classId);
            $this->view->showPartialView();
        }

        public function getClassTasks(){
            $classId = $this->urlElements[2];
            if (!is_numeric($classId)) return;

            $this->view->setViewPath('teacher/homework/partialviews/classTasks.php');
            $this->view->tasks = getClassTasks($classId);
            $this->view->classId = $classId;
            $this->view->showPartialView();
        }

        public function editTask(){
            $taskId = $this->urlElements[2];
            $this->view->setViewPath('teacher/homework/partialviews/editTask.php');
            $this->view->task = getClassTask($taskId);
            $this->view->showPartialView();
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
            $this->view->schoolClasses = getMyClasses($this->user->username);
            $this->view->showPage();
        }

        public function getCategories(){
            $subjectID = $this->urlElements[2];
            $this->view->setViewPath('teacher/homework/partialviews/addTaskCategories.php');
            $this->view->categories = getSubjectCategories($subjectID);
            $this->view->showPartialView();
        }

        public function getCategoryContent(){
            $categoryid = $this->urlElements[2];
            $this->view->setViewPath('teacher/homework/partialviews/addTaskCategoryContent.php');
            $this->view->categoryContent = getCategoryContent($categoryid);
            $this->view->showPartialView();
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
            $this->view->showPartialView();

        }
        public function deletePendingTask(){
            deletePendingTask($this->urlElements[2], $this->urlElements[3]);
        }

        public function choosePupils(){
            $classid = $this->urlElements[2];
            $username = $this->user->username;
            $this->view->setViewPath('/teacher/homework/choosePupils.php');
            $this->view->classid = $classid;
            $this->view->pupils = getPupils($classid);
            $this->view->pendingTasks = getPendingTasks($classid, $username);
            if(arrayEmpty($this->view->pendingTasks)){
                $_SESSION['error'] = "Du har ikke valgt noen gjøremål";
                return $this->addTask();
            }
            $this->view->showPage();
        }

        public function acceptTasks(){
            if(!isset($_POST['pupils'])){
                $_SESSION['error'] = "Du har ikke valgt noen elever";
                header("Location: /teacher/choosePupils/".$_POST['classid']);
                exit;
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
            $this->view->showPartialView();
        }

        public function teacherPersonalPage () {
            $this->view->setViewPath('teacher/teacherPersonalPage.php');
            $this->view->teacher = getTeacher($this->user->username);
            $this->view->showPage();
        }

        public function doChangePassword () {
            changePassword($this->user->username, $_POST['currentPassword'], $_POST['newPassword1'], $_POST['newPassword2']);
            header("Location: /teacher/teacherPersonalPage");
            exit;
        }

        public function doChangeEmail () {
            changeEmail($this->user->username, $_POST['email']);
            header("Location: /teacher/teacherPersonalPage");
            exit;
        }

        protected function checkUserAccess(){
            $user = $this->user;
            if(!isset($user) || !$user->isTeacher()){
                header("Location: /login");
                exit;
            }
        }

    }