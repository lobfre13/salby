<?php

    class router{
        private $urlElements;
        private $controller;

        private function getUrlElements(){
            $path = ltrim($_SERVER['REQUEST_URI'], '/');
            return explode('/', $path);
        }

        private function getController() {
            global $root;
            if (empty($this->controller)) {
                $this->controller = 'main';
                $this->urlElements[0] = 'main';
            }

            return $file = $root.'/app/controller/' . $this->controller . '_controller.php';
        }

        public function loadController(){
            global $root;
            $this->urlElements = $this->getUrlElements();
            $this->controller = $this->urlElements[0];
            $controllerPath = $this->getController($this->controller);

            if (is_readable($controllerPath) == false)
            {
                echo $this->controller;
                die (' 404 Not Found');
            }
            $user = null;
            if(isset($_SESSION['user']))
                $user = $_SESSION['user'];

            include $controllerPath;
            include 'register.php';
            $register = new register($root, $user ,$this->urlElements, $_SERVER['REQUEST_METHOD']);

            $class = $this->controller . 'Controller';
            new $class($register);
        }
    }