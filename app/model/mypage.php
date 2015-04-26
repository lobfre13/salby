<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 15:09
 */

    function getWeekNumber () {
        date_default_timezone_set(date_default_timezone_get());
        $date = date('m/d/Y h:i:s a', time());
        $dateTime = new DateTime($date);
        $week = $dateTime->format("W");
        return $week;
    }

    function getStudentFullName ($username) {
        global $database;
        $sql = $database->prepare("SELECT * FROM users WHERE username = :username");

        $sql->execute(array(
            'username' => $username
        ));

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function getHomeworkSubjects($classId){
        global $database;
        $sql = $database->prepare("SELECT lo.title, h.id, h.duedate, h.url, s.subjectname, ph.isdone
            FROM learningobjects as lo
            JOIN homework as h ON h.learningobjectid = lo.id
            JOIN classsubjects ON h.classsubjectid = classsubjects.id
            JOIN subjects as s ON subjectid = s.id
            JOIN pupilhomework as ph ON homeworkid = h.id
            WHERE classid = :classId");

        $sql->execute(array(
            'classId' => $classId
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function updateHomeworkStatus($username, $homeworkid){
        if(homeworkIsDone($username, $homeworkid)){
            undoHomework($username, $homeworkid);
        }
        else doHomework($username, $homeworkid);
    }

    function homeworkIsDone($username, $homeworkid) {
        global $database;
        $sql = $database->prepare("SELECT * FROM pupilhomework WHERE username = :username AND homeworkid = :homeworkid");

        $sql->execute(array(
            'username' => $username,
            'homeworkid' => $homeworkid
        ));
        return $sql->fetch(PDO::FETCH_ASSOC)['isdone'] == 1;
    }

    function undoHomework($username, $homeworkid){
        global $database;
        $sql = $database->prepare("UPDATE pupilhomework SET isdone = 0
                                    WHERE username = :username AND homeworkid = :homeworkid");

        $sql->execute(array(
            'username' => $username,
            'homeworkid' => $homeworkid
        ));
    }

    function doHomework($username, $homeworkid){
        global $database;
        $sql = $database->prepare("UPDATE pupilhomework SET isdone = 1
                                    WHERE username = :username AND homeworkid = :homeworkid");

        $sql->execute(array(
            'username' => $username,
            'homeworkid' => $homeworkid
        ));
    }
