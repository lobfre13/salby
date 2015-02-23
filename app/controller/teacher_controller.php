<?php
    class teacherController{

        private $user;
        private $root;

        public function __construct($urlElements){
            $this->root = $GLOBALS->root;
            $this->user = $_SESSION['user'];
            if(!isset($this->user) && !$this->user->isTeacher()){
                header("Location: /login");
                exit;
            }

            include $this->root.'/app/model/teacher.php';

            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'GET'){
                if(isset($urlElements[1]))
                    $this->showClass($urlElements[1]);
                else
                    $this->index();
            }
            else if($method == 'POST')
                if(isset($urlElements[1])){
                    if(isset($_POST['subjectid']))
                        $this->addSubject($urlElements[1]);
                    else
                        $this->createUsers($urlElements[1]);
                }
        }

        private function index(){
            $schoolClasses = getMyClasses($this->user);
            include $this->root.'/app/views/template/header.php';
            include $this->root.'/app/views/template/headerMenu.php';
            include $this->root.'/app/views/teacher/teacher.php';
            include $this->root.'/app/views/template/footer.php';
        }

        private function showClass($id){
            if(!is_numeric($id)) return $this->index();

            $schoolClass = getClass($id);
            $pupils = getPupils($id);
            $subjects = getClassSubjects($id);
            $allSubjects = getAllSubjects();
            include $this->root.'/app/views/template/header.php';
            include $this->root.'/app/views/template/headerMenu.php';
            include $this->root.'/app/views/teacher/teacherClass.php';
            include $this->root.'/app/views/template/footer.php';
        }

        private function createUsers($id){
            if(!is_numeric($id)) return $this->index();

            createUsers($id);
            $this->showClass($id);
        }

        private function addSubject($id){
            if(!is_numeric($id)) return $this->index();

            doAddSubject($id);
            $this->showClass($id);
        }


    }