<?php

    class router{
        private $urlElements;
        private $controller;
        private $action;
        private $user;

        public function __construct(){
            $this->initUrlElements();
            $this->initUser();
            $this->initController($this->user);
            $this->initAction();
        }

        private function initUrlElements(){
            $path = ltrim($_SERVER['REQUEST_URI'], '/');
            $this->urlElements = explode('/', $path);
        }

        private function initUser(){
            if(isset($_SESSION['user'])) $this->user = $_SESSION['user'];
            else $this->user = null;
        }

        private function initController($user) {
            if (empty($this->urlElements[0])){
                $this->controller = $this->urlElements[0] = $this->getStartPage($user);
            }
            else $this->controller = $this->urlElements[0];
        }

        private function initAction(){
            if(empty($this->urlElements[1])) $this->action = 'index';
            else $this->action = $this->urlElements[1];
        }

        private function validateController($controllerPath){
            if (!is_readable($controllerPath)) {
                echo $this->controller;
                die (' 404 Not Found');
            }
        }

        private function validateAction($controller){
            if(!is_callable(array($controller, $this->action))){
                echo $this->action;
                die (' 404 Not Found');
            }
        }

        private function getStartPage($user){
            if(isset($this->user)){
                if($user->isAdmin())        return $GLOBALS['adminRootPage'];
                else if($user->isTeacher()) return $GLOBALS['teacherRootPage'];
                else if($user->isSchool())  return $GLOBALS['schoolRootPage'];
            }
            return $GLOBALS["mainRootPage"];
        }

        public function loadController(){
            global $rootPath;
            $controllerPath = $rootPath.'/app/controller/' . $this->controller . '_controller.php';
            $action = $this->action;
            $this->validateController($controllerPath);

            include $controllerPath;
            include 'register.php';
            $register = new register($rootPath, $this->user ,$this->urlElements, $_SERVER['REQUEST_METHOD']);

            $class = $this->controller . 'Controller';
            $controller = new $class($register);
            $this->validateAction($controller);
            $controller->$action();
        }
    }