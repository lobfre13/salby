<?php

    function slugify($text){
        $text = str_replace('-', '_', $text);
        $text = str_replace(' ', '-', $text);
        $text = str_replace('æ', 'ae', $text);
        $text = str_replace('ø', 'oe', $text);
        $text = str_replace('å', 'aa', $text);
        $text = str_replace('Æ', 'AE', $text);
        $text = str_replace('Ø', 'OE', $text);
        $text = str_replace('Å', 'AA', $text);

        return $text;
    }

    function deSlugify($text){
        $text = str_replace('-', ' ', $text);
        $text = str_replace('_', '-', $text);
        $text = str_replace('ae', 'æ', $text);
        $text = str_replace('oe', 'ø', $text);
        $text = str_replace('aa', 'å', $text);
        $text = str_replace('AE', 'Æ', $text);
        $text = str_replace('OE', 'Ø', $text);
        $text = str_replace('AA', 'Å', $text);

        return $text;
    }

    function arrayEmpty($arr){
        $arr = array_filter($arr);
        return empty($arr);
    }