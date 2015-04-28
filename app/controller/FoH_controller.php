<?php

class FoHController extends superController{

    public function __construct($register){
        parent::__construct($register);
    }

    public function index($failedLogin = false){

        echo "Here are our files<br><br>";
        $path = "./public/lobjects/FoH";
        $dh = opendir($path);
        $i=1;
        while (($file = readdir($dh)) !== false) {
            if($file != "." && $file != ".." && $file != "index.php" && $file != ".htaccess" && $file != "error_log" && $file != "cgi-bin") {
                echo "<a href='$path/$file'>$file</a><br /><br />";
                $i++;
            }
        }
        closedir($dh);

    }

    protected function checkUserAccess(){
    }
}
