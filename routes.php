<?php
    $mainRootPage = 'main';
    $adminRootPage = 'admin';
    $teacherRootPage = 'teacher';
    $schoolRootPage = 'schooladmin';


    $alias = [];
    $frontPageKeys = array('forside', 'startside');
    $subjectActionKeys = array('fag');


    $alias = array_merge(array_fill_keys($frontPageKeys, 'main'), $alias);
    $alias = array_merge(array_fill_keys($subjectActionKeys, 'subject'), $alias);

    function alias($key){
        global $alias;
        if(array_key_exists($key, $alias)) return $alias[$key];
        return $key;
    }
