/**
* Created by PhpStorm.
* User: Simen Fonnes
* Date: 24.02.2015
* Time: 12:39
*/
<?php
    class GeneratePage {

        private $root;

        public function __construct ($body, $user, $root) {
            $this->root = $root;
            $this->addHeader();
            if (isset($user)) $this->addHeaderMenu();
            $this->addMainContent($body);
            $this->addFooter();
        }

        private function addHeader () {
            include $this->root.'/app/views/template/header.php';
        }

        private function addHeaderMenu () {
            include $this->root.'/app/views/template/headerMenu.php';
        }

        private function addFooter () {
            include $this->root.'/app/views/template/footer.php';
        }

        private function addMainContent ($body) {
            include $this->root.$body;
        }
    }

