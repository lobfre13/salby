<?php

    include_once 'dbInterface.php';

    function getSubject($classLevel, $subjectName){
        $sqlString = "SELECT * FROM subjects WHERE subjectname = :subjectname AND classlevel = :classlevel";
        $params = array(
            'subjectname' => $subjectName,
            'classlevel' => $classLevel
        );
        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function getClassLevel($classID){
        $sqlString = "SELECT * FROM classes WHERE id = :classid";
        $params = array('classid' => $classID);

        return query($sqlString, $params, DBI::FETCH_ONE)['classlevel'];
    }

    function getSubjectCategories($subjectID){
        $sqlString = "SELECT * FROM categories
                      JOIN subjectcategory ON id = categoryid
                      WHERE subjectid = :subjectid";
        $params = array('subjectid' => $subjectID);

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function getCategory($categoryName){
        $sqlString = "SELECT * FROM categories WHERE category = :category";
        $params = array('category' => $categoryName);

        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function getSubCategories($categoryID){
        $sqlString = "SELECT * FROM categories WHERE parentid = :parentid";
        $params = array('parentid' => $categoryID);

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function getLObjects($categoryID){
        $sqlString = "SELECT * FROM learningobjects
                      JOIN learningobjectcategory ON learningobjectid = learningobjects.id
                      WHERE categoryid = :categoryid";
        $params = array('categoryid' => $categoryID);

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function getLObject($lObjectTitle){
        $sqlString = "SELECT * FROM learningobjects WHERE title = :title";
        $params = array('title' => $lObjectTitle);

        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function getUserSubjects($classID){
        $sqlString = "SELECT * from classsubjects
                      JOIN subjects ON subjectid = subjects.id
                      WHERE classid = :classid";
        $params = array('classid' => $classID);

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function getLObjectFromID($LObjectID){
        $sqlString = "SELECT * FROM learningobjects WHERE id = :LObjectID";
        $params = array('LObjectID' => $LObjectID);

        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function getSubjects($classLevel){
        $sqlString = "SELECT * FROM subjects WHERE classlevel = :classLevel";
        $params = array('classLevel' => $classLevel);

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function manageSubjectState($subjects, $selectedSubject, $frontPage){
        foreach ($subjects as &$subject){
            if(!$frontPage){
                if(strcasecmp($subject['subjectname'], $selectedSubject) == 0) $subject['htmlClasses'] = 'subject subjectNormal selectedSubject';
                else  $subject['htmlClasses'] = 'subject subjectNormal';
            }
            else $subject['htmlClasses'] = 'subject';
        }
        return $subjects;
    }

    function getFilePathURLS($url){
        $filePathURLS = [];
        $baseURL = slugify('/'.join('/', array_slice($url, 0, 3)));
        for($i = 3; $i < count($url); $i++){
            $baseURL = $baseURL.'/'.slugify($url[$i]);
            $filePathURLS []= [$baseURL, $url[$i]];
        }
        return $filePathURLS;
    }

    function getLObjectPath($LObjectID){
        $pathNames = [];

    }

    function getCategoryContent($categoryid){
        $content = getLObjects($categoryid);
        $content = array_merge($content, getSubCategories($categoryid));
        return $content;
    }

    function getCategoryContentFromName($categoryName){
        $category = getCategory($categoryName);
        if(empty($category)) return [];
        return getCategoryContent($category['id']);
    }

    function getHomeworkCount ($username) {
        $sqlString = "SELECT COUNT(isdone) AS homeworkCount FROM pupilhomework WHERE username = :username AND isdone = 0";
        $params = array('username' => $username);
        return query($sqlString, $params, DBI::FETCH_ONE);
    }