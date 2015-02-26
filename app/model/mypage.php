<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 15:09
 */

    function doGetHomework ($classSubjectId) {
        global $database;
        $sql = $database->prepare("SELECT * FROM learningobjects
          JOIN homework ON homework.learningobjectid = learningobjects.id
          JOIN classsubjects ON classsubjects.id = homework.classsubjectid
          WHERE classid = :classSubjectId");

        $sql->execute(array(
            'classSubjectId' => $classSubjectId
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }