<?php
    class mainController{
        private $user;

        public function __construct($urlElements){
            $this->user = $_SESSION['user'];
            if(!isset($this->user)){
                header("Location: /login");
                exit;
            }
            include '/app/model/lobjects.php';
            $method = $_SERVER['REQUEST_METHOD'];
            if($method == 'GET')
                $this->index();
            else if($method == 'POST')
                ;
        }

        private function index(){
            $lobjects = getUserLobjects($this->user);
            $subjects = getUserSubjects($this->user);
            include '/app/views/template//header.php';
            include '/app/views/template/headerMenu.php';
            include '/app/views/main.php';
            include '/app/views/template/footer.php';
        }

    }