<?php

    function slugify($text){
        $text = strtolower($text);
        $text = str_replace('-', '_', $text);
        $text = str_replace(' ', '-', $text);
        $text = str_replace('æ', 'ae', $text);
        $text = str_replace('ø', 'oe', $text);
        $text = str_replace('å', 'aa', $text);


        return $text;
    }

    function deSlugify($text){
        $text = str_replace('-', ' ', $text);
        $text = str_replace('_', '-', $text);
        $text = str_replace('ae', 'æ', $text);
        $text = str_replace('oe', 'ø', $text);
        $text = str_replace('aa', 'å', $text);

        return $text;
    }

    function arrayEmpty($arr){
        $arr = array_filter($arr);
        return empty($arr);
    }