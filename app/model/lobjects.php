<?php

    function getUserLobjects($user){
        global $database;
        $sql = $database->prepare("SELECT * FROM classsubject
                                  join subject on subject.id = classsubject.subjectid
                                  join subjectcategory on subjectcategory.subjectid = subject.id
                                  join category on categoryid = category.id
                                  join learningobjectcategory on learningobjectcategory.categoryid = category.id
                                  join learningobjects on learningobjectid = learningobjects.id
                                  where classid=:classid");
        $sql->execute(array(
            'classid' => $user->getClassID()
        ));
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