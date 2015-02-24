/**
* Created by PhpStorm.
* User: Simen Fonnes
* Date: 24.02.2015
* Time: 12:39
*/
<?php
    class GeneratePage {

        public function __construct ($body, $userName, $classID, $role) {
            if (!isset($this->user) && !$this->getWhichUser($userName, $classID, $role)->isAdmin()) {
                $this->addHeader();
                $this->addHeaderMenu();
                $this->addMainContent($body);
                $this->addFooter();
            } else {
                header("Location: /");
                exit;
            }
        }

        private function getWhichUser ($userName, $classID, $role) {
            include '/app/model/user.php';
            return new user($userName, $classID, $role);
        }

        private function addHeader () {
            include '/app/views/template/header.php';
        }

        private function addHeaderMenu () {
            include '/app/views/template/headerMenu.php';
        }

        private function addFooter () {
            include '/app/views/template/footer.php';
        }

        private function addMainContent ($body) {
            include $body;
        }
    }

