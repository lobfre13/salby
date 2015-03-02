<?php

    function getUserCategories($subjectID){
        global $database;
        $sql = $database->prepare("SELECT categories.imgurl, categories.category, categories.id
                                   FROM categories
                                   JOIN subjectcategory ON subjectcategory.categoryid = categories.id
                                   JOIN subjects ON subjects.id = subjectcategory.subjectid
                                   WHERE subjects.id = :subjectid");
        $sql->execute(array(
            'subjectid' => $subjectID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    function getAllLobjects($categoryID){
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects
                                   JOIN learningobjectcategory ON learningobjectid = learningobjects.id
                                   WHERE categoryid = :categoryid");
        $sql->execute(array(
            'categoryid' => $categoryID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getSubCategories($categoryID){
        global $database;
        $sql = $database->prepare("SELECT * FROM categories
                                   WHERE parentid = :parentid");
        $sql->execute(array(
            'parentid' => $categoryID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
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