<?php
    class view{
        private $data;
        private $viewPath;
        private $headerMenuHidden;

        public function __construct($viewPath){
            $this->setViewPath($viewPath);
            $this->hideHeaderMenu(false);
            $this->data = [];
        }

        public function __get($attribute){
            if(isset($this->data[$attribute])) return $this->data[$attribute];
            else return null;
        }

        public function __set($key, $val) {
            $this->data[$key] = $val;
        }

        public function setViewPath($viewPath)
        {
            $this->viewPath = $viewPath;
        }

        public function hideHeaderMenu($hide){
            $this->headerMenuHidden = $hide;
        }

        public function showPage(){
            include $this->root.'/app/views/template/header.php';
            if(!$this->headerMenuHidden) include $this->root.'/app/views/template/headerMenu.php';
            include $this->root.'/app/views/'.$this->viewPath;
            include $this->root.'/app/views/template/footer.php';
        }

        public function showStrippedPage(){
            include $this->root.'/app/views/'.$this->viewPath;
        }
    }