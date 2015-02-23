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
            if (empty($this->controller))
                $this->controller = 'main';

            return $file = $root.'app/controller/' . $this->controller . '_controller.php';
        }

        public function loadController(){
            $this->urlElements = $this->getUrlElements();
            $this->controller = $this->urlElements[0];
            $controllerPath = $this->getController($this->controller);

            if (is_readable($controllerPath) == false)
            {
                echo $this->controller;
                die (' 404 Not Found');
            }

            include $controllerPath;

            $class = $this->controller . 'Controller';
            new $class($this->urlElements);
        }
    }