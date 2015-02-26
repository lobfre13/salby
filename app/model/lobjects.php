<?php

    function getUserCategories($user){
        global $database;
        $sql = $database->prepare("SELECT classsubjects.subjectid, categories.imgurl, categories.category, categories.id
                                  FROM classsubjects
                                  join subjectcategory on subjectcategory.subjectid = classsubjects.subjectid
                                  join categories on categoryid = categories.id
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
        $sql = $database->prepare("SELECT * from classsubjects JOIN subjects on subjectid = subjects.id WHERE classid = :classid");
        $sql->execute(array(
            'classid' => $user->getClassID()
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }