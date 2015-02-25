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

        protected function checkUserAccess(){
            $user = $this->getRegister()->getUser();
            if(!isset($user)){
                header("Location: /login");
                exit;
            }
        }

        protected function routeAction () {
            $urlElements = $this->getRegister()->getUrlElements();
            switch($this->getRegister()->getRequestMethod()) {
                case 'GET':
                    if (isset($urlElements[2])) {
                        $this->addLObject($urlElements[2]);
                    } else {
                        header("Location: /");
                        exit;
                    }
                    $this->index();
                    break;

                case 'POST':
                    $this->updateFavourite($urlElements[2]);
                    $this->index();
                    break;
            }
        }

        private function addLObject () {
            //Denne metoden må lages.
        }

        private function updateFavourite ($lObjectId) {
            doUpdateFavourite($this->getRegister()->getUser()->getUsername(), $lObjectId);
        }

        private function index () {
            $this->showFullHeader();
            include $this->getRegister()->getRoot().'/app/views/game_view.php';
            $this->showFooter();
        }
    }
