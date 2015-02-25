<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 24.02.2015
 * Time: 14:56
 */

    class gameController extends superController {

        public function __construct ($register) {
            parent::__construct($register);
            $this->checkUserAccess();
            include $this->getRegister()->getRoot().'/app/model/game.php';
            $this->routeAction();
        }

        protected function checkUserAccess () {
            if(!isset($user)) {
                header("Location: /login");
                exit;
            }
        }

        protected function routeAction () {
            $urlElements = $this->getRegister()->getUrlElements();
            switch($this->getRegister()->getRequestMethod()) {
                case 'GET':
                    if (isset($urlElements[2])) {
                        $this->addLObject($this->showSubject($urlElements[2]));
                    } else {
                        header("Location: /");
                        exit;
                    }
                    break;

                case 'POST':
                    $this->updateFavourite($this->showSubject($urlElements[2]));
                    break;
            }
        }

        private function addLObject () {

        }

        private function updateFavourite ($lObjectId) {
            $this->doUpdateFavourite($_SESSION['user'], $lObjectId);
        }
    }
