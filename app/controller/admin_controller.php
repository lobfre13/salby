<?php
    class adminController{

        private $user;
        private $root;

        public function __construct($urlElements){
            $this->root = $_SERVER["DOCUMENT_ROOT"];
            $this->user = $_SESSION['user'];
            if (!isset($this->user) && !$this->user->isAdmin()) {
                header("Location: /login");
                exit;
            }
            include $this->root.'/app/model/admin.php';

            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == 'GET') {
                if (isset($urlElements[2])) {
                    $this->showSubject($urlElements[2]);
                }
                else {
                    $this->index();
                }
            }
            else if ($method == 'POST') {
                if (isset($urlElements[2])){
                    $this->addCategory($urlElements[2]);
                }
                else{
                    if(isset($_POST['lobjecttitle'])){
                        $this->addLObject();
                    }
                    else{
                        $this->addSubject();
                    }
                }
            }
        }



        private function index(){
            $subjects = getSubjects();
            $categories = getAllCategories();
            include $this->root.'/app/views/template/header.php';
            include $this->root.'/app/views/template/headerMenu.php';
            include $this->root.'/app/views/admin/admin.php';
            include $this->root.'/app/views/template/footer.php';
        }

        private function addSubject(){
            doAddSubject();
            $this->index();
        }

        private function showSubject($id){
            if(!is_numeric($id)) return $this->index();

            $subject = getSubject($id);
            $categories = getCategories($subject['id']);

            include $this->root.'/app/views/template/header.php';
            include $this->root.'/app/views/template/headerMenu.php';
            include $this->root.'/app/views/admin/subject.php';
            include $this->root.'/app/views/template/footer.php';

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

    }
