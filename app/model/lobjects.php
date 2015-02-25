<?php

    function getUserCategories($user){
        global $database;
        $sql = $database->prepare("SELECT classsubject.subjectid, category.imgurl, category.category, category.id
                                  FROM classsubject
                                  join subjectcategory on subjectcategory.subjectid = classsubject.subjectid
                                  join category on categoryid = category.id
                                  where classid=:classid");
        $sql->execute(array(
            'classid' => $user->getClassID()
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }

    function getAllLobjects(){
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects
                                  JOIN learningobjectcategory ON learningobjectid = learningobjects.id
                                  ");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function getUserSubjects($user){
        global $database;
        $sql = $database->prepare("SELECT * from classsubject JOIN subject on subjectid = subject.id WHERE classid = :classid");
        $sql->execute(array(
            'classid' => $user->getClassID()
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }