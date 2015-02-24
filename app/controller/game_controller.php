<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 24.02.2015
 * Time: 14:56
 */

    class game_controller {

        //Fields
        private $generatePage;

        public function __construct () {
             $this->setGeneratePage();
        }

        private function setGeneratePage () {
            include "../generate_page.php";
            $this->$generatePage = new generate_page($this->createBody, $_SESSION['user'], $_SERVER["DOCUMENT_ROOT"]);
        }

        private function createBody () { return ""; }

        public function getGeneratePage () { return $this->generatePage; }
    }
