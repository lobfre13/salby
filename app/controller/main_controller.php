<?php
    class mainController{
        private $user;
        private $root;

        public function __construct($urlElements){
            $this->root = $_SERVER["DOCUMENT_ROOT"];
            $this->user = $_SESSION['user'];
            if(!isset($this->user)){
                header("Location: /login");
                exit;
            }
            $this->gotoStartPage();
            include $this->root.'/app/model/lobjects.php';
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'GET')
                $this->index();
            else if($method == 'POST')
                ;
        }

        private function index(){
            $lobjects = getUserLobjects($this->user);
            $subjects = getUserSubjects($this->user);
            include $this->root.'/app/views/template//header.php';
            include $this->root.'/app/views/template/headerMenu.php';
            include $this->root.'/app/views/main.php';
            include $this->root.'/app/views/template/footer.php';
        }

        private function gotoStartPage(){
            if($this->user === 'admin'){
                header("Location: /admin");
                exit;
            }
            else if($this->user === 'teacher'){
                header("Location: /teacher");
                exit;
            }
            else if($this->user === 'school'){
                header("Location: /schooladmin");
                exit;
            }

        }


    }