<?php

    function getSubject($classLevel, $subjectName){
        global $database;
        $sql = $database->prepare("SELECT * FROM subjects WHERE subjectname = :subjectname AND classlevel = :classlevel");

        $sql->execute(array(
            'subjectname' => $subjectName,
            'classlevel' => $classLevel
        ));
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function getClassLevel($classID){
        global $database;
        $sql = $database->prepare("SELECT * FROM classes WHERE id = :classid");
        $sql->execute(array(
            'classid' => $classID
        ));
        return $sql->fetch(PDO::FETCH_ASSOC)['classlevel'];
    }

    function getSubjectCategories($subjectID){
        global $database;
        $sql = $database->prepare("SELECT * FROM categories
                                   JOIN subjectcategory ON id = categoryid
                                   WHERE subjectid = :subjectid");
        $sql->execute(array(
            'subjectid' => $subjectID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCategory($categoryName){
        global $database;
        $sql = $database->prepare("SELECT * FROM categories WHERE category = :category");
        $sql->execute(array(
            'category' => $categoryName
        ));
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function getSubCategories($categoryID){
        global $database;
        $sql = $database->prepare("SELECT * FROM categories WHERE parentid = :parentid");
        $sql->execute(array(
            'parentid' => $categoryID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLObjects($categoryID){
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects
                                   JOIN learningobjectcategory ON learningobjectid = learningobjects.id
                                   WHERE categoryid = :categoryid");
        $sql->execute(array(
            'categoryid' => $categoryID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getLObject($lObjectTitle){
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects
                                   WHERE title = :title");
        $sql->execute(array(
            'title' => $lObjectTitle
        ));
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function getUserSubjects($user){
        global $database;
        $sql = $database->prepare("SELECT * from classsubjects
                                       JOIN subjects ON subjectid = subjects.id
                                       WHERE classid = :classid");
        $sql->execute(array(
            'classid' => $user->getClassID()
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getFilePathURLS($url){
        $filePathURLS = [];
        $baseURL = '/'.join('/', array_slice($url, 0, 3));
        for($i = 3; $i < count($url); $i++){
            $baseURL = $baseURL.'/'.$url[$i];
            $filePathURLS []= [$baseURL, $url[$i]];
        }
        return $filePathURLS;
    }