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

        protected function routeAction() {
            $urlElements = $this->getRegister()->getUrlElements();
            switch($this->getRegister()->getRequestMethod()) {
                case 'GET':
                    if (isset($urlElements[2])) $this->index($urlElements[2]);
                    else {
                        header("Location: /");
                        exit;
                    }
                    break;
                case 'POST':
                    if (isset($urlElements[2])) $this->updateFavourite($urlElements[2]);
                    break;
            }
        }

        private function updateFavourite($lObjectId) {
            doUpdateFavourite($this->getRegister()->getUser()->getUsername(), $lObjectId);
            $this->index($lObjectId);
        }

        private function index($id){
            if(!is_numeric($id)){
                header("Location: /");
                exit;
            }

            $lobject = getLObject($id);

            $this->showFullHeader();
            include $this->getRegister()->getRoot().'/app/views/game_view.php';
            $this->showFooter();
        }
    }
