<?php
    //    http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
    function slugify($text){
        $text = str_replace(' ', '-', $text);
        $text = str_replace('æ', 'ae', $text);
        $text = str_replace('ø', 'oe', $text);
        $text = str_replace('å', 'aa', $text);

        // lowercase
        $text = strtolower($text);

        return $text;
    }

    // http://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
    function deSlugify($text){
        $text = str_replace('-', ' ', $text);
        $text = str_replace('ae', 'æ', $text);
        $text = str_replace('oe', 'ø', $text);
        $text = str_replace('aa', 'å', $text);

        // lowercase
        $text = strtolower($text);

        return $text;
    }