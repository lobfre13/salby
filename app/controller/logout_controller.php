<?php
    class logoutController
    {
        public function __construct($urlElements){
            session_destroy();
            header("Location: /");
        }
    }