<?php
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 25.02.2015
 * Time: 15:09
 */

    include_once 'dbInterface.php';

    function getWeekNumber () {
        date_default_timezone_set(date_default_timezone_get());
        $date = date('m/d/Y h:i:s a', time());
        $dateTime = new DateTime($date);
        $week = $dateTime->format("W");
        return $week;
    }

    function getStudentFullName ($username) {
        $sqlString = "SELECT * FROM users WHERE username = :username";
        $params = array(
            'username' => $username
        );
        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function getHomeworkSubjects($classId, $username){
        $sqlString = "SELECT lo.title, h.id, h.duedate, h.url, s.subjectname, ph.isdone
            FROM learningobjects as lo
            RIGHT JOIN homework as h ON h.learningobjectsid = lo.id
            JOIN classsubjects ON h.classsubjectid = classsubjects.id
            JOIN subjects as s ON subjectid = s.id
            JOIN pupilhomework as ph ON homeworkid = h.id
            WHERE classid = :classId AND username = :username
            ORDER BY h.duedate, lo.title";
        $params = array(
            'classId' => $classId,
            'username' => $username
        );
        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function updateHomeworkStatus($username, $homeworkid){
        if(homeworkIsDone($username, $homeworkid)){
            undoHomework($username, $homeworkid);
        }
        else doHomework($username, $homeworkid);
    }

    function homeworkIsDone($username, $homeworkid) {
        $sqlString = "SELECT * FROM pupilhomework WHERE username = :username AND homeworkid = :homeworkid";
        $params = array(
            'username' => $username,
            'homeworkid' => $homeworkid
        );
        return query($sqlString, $params, DBI::FETCH_ONE)['isdone'] == 1;
    }

    function undoHomework($username, $homeworkid){
        $sqlString = "UPDATE pupilhomework SET isdone = 0
                      WHERE username = :username AND homeworkid = :homeworkid";
        $params = array(
            'username' => $username,
            'homeworkid' => $homeworkid
        );
        query($sqlString, $params);
    }

    function doHomework($username, $homeworkid){
        $sqlString = "UPDATE pupilhomework SET isdone = 1
                      WHERE username = :username AND homeworkid = :homeworkid";
        $params = array(
            'username' => $username,
            'homeworkid' => $homeworkid
        );
        query($sqlString, $params);
    }
