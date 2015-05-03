<?php
include_once 'dbInterface.php';
    function getMyClasses($username){
        $sqlString = "SELECT c.classname, c.classlevel, s.subjectname, cs.id, cs.subjectid FROM classes as c
                                  JOIN classsubjects as cs ON cs.classid = c.id
                                  JOIN classsubjectteachers as cst ON cst.classsubjectid = cs.id
                                  JOIN subjects as s ON s.id = cs.subjectid
                                  WHERE cst.username = :username
                                  ORDER BY c.classlevel, c.classname";
        $params = array(
            'username' => $username
        );

        return query($sqlString, $params, DBI::FETCH_ALL);

    }

    function getClassPupils($classID){
        $sqlString = "SELECT * FROM users
                      WHERE classid = :classid";
        $params = array(
            'classid' => $classID
        );

        return query($sqlString, $params, DBI::FETCH_ALL);

    }

    function getClassTasks($classID){
        $sqlString = "SELECT lo.title, h.duedate, h.url, h.id FROM learningobjects as lo
                                   JOIN homework as h ON h.learningobjectsid = lo.id
                                   JOIN classsubjects as cs ON cs.id = h.classsubjectid
                                   WHERE cs.classid = :classid";
        $params = array(
            'classid' => $classID
        );

        return query($sqlString, $params, DBI::FETCH_ALL);

    }

    function getClassTask($taskID){
        $sqlString = "SELECT duedate, title, homework.id FROM homework
                                    JOIN learningobjects as lo ON lo.id = learningobjectsid
                                    WHERE homework.id = :taskid";
        $params = array(
            'taskid' => $taskID
        );

        return query($sqlString, $params, DBI::FETCH_ONE);

    }

    function updateClassTask($taskid, $date){
        $sqlString = "UPDATE homework
                      SET duedate = :duedate
                      WHERE id = :id";
        $params = array(
            'duedate' => $date,
            'id' => $taskid
        );

        query($sqlString, $params);

    }

    function deleteClassTask($taskID){
        $sqlString = "DELETE FROM pupilhomework WHERE homeworkid = :id";
        $params = array('id' => $taskID);
        query($sqlString, $params);

        $sqlString = "DELETE FROM homework WHERE id = :id";
        query($sqlString, $params);

    }

    function addPendingTask($taskID, $username, $classSubjectID){
        $pendingHomeworkClassID = getPendingHomeworkClassID($username, $classSubjectID);
        $sqlString = "INSERT INTO pendinghomeworklist VALUES(:taskid, :phcid)";
        $params = array(
            'taskid' => $taskID,
            'phcid' => $pendingHomeworkClassID
        );

        query($sqlString, $params);

    }

    function getPendingHomeworkClassID($username, $classSubjectID){
        $sqlString = "SELECT * FROM pendinghomeworkclass WHERE classsubjectid = :csid AND username = :username";
        $params = array(
            'csid' => $classSubjectID,
            'username' => $username
        );
        $result = query($sqlString, $params, DBI::FETCH_ONE);
        if (isset($result['id'])) return $result['id'];
        return getNewPendingHomeworkEntryID($username, $classSubjectID);

    }

    function getNewPendingHomeworkEntryID($username, $classSubjectID){
        $sqlString = "INSERT INTO pendinghomeworkclass VALUES(null, :csid, :username)";
        $params = array(
            'csid' => $classSubjectID,
            'username' => $username
        );
        return query($sqlString, $params, DBI::LAST_ID);


    }

    function getPendingTasks($subjectID, $username){
        $sqlString = "SELECT * FROM pendinghomeworklist
                                   JOIN learningobjects as lo ON lo.id = learningobjectid
                                   JOIN pendinghomeworkclass as phc ON phc.id = pendinghomeworkclassid
                                   WHERE phc.username = :username AND phc.classsubjectid = :csid";
        $params = array('csid' => $subjectID, 'username' => $username);
        return query($sqlString, $params, DBI::FETCH_ALL);

    }

    function getPupils($classSubjectID){
        $sqlString = "SELECT * FROM users
                      JOIN classes  as c ON c.id = users.classid
                      JOIN classsubjects as cs ON cs.classid = c.id
                      WHERE cs.id = :classsubjectid";
        $params = array(
            'classsubjectid' => $classSubjectID
        );

        return query($sqlString, $params, DBI::FETCH_ALL);

    }

    function getPupilsFromUsername($usernames){
        if(count($usernames) < 1) return null;
        global $database;
        $qMarks = str_repeat('?,', count($usernames) - 1) . '?';

        $sqlString = "SELECT * FROM users WHERE username in(" . $qMarks . ")";
        return query($sqlString, $usernames, DBI::FETCH_ALL);

    }

    function addHomework($pendingTasks, $pupilUsernames, $classid){
        foreach($pendingTasks as $task){
            $sqlString = "INSERT INTO homework VALUES(null, :csid, :taskid, null, '/forside/fag/1-klasse/norsk/mockURL/" . $task['title'] . "')";
            $params = array(
                'csid' => $classid,
                'taskid' => $task['learningobjectid']
            );
            $id = query($sqlString, $params, DBI::LAST_ID);

            addPupilToHomework($pupilUsernames, $id);
        }
    }

    function addPupilToHomework($pupilUsernames, $id){
        foreach($pupilUsernames as $username){
            $sqlString = "INSERT INTO pupilhomework VALUES(:username, :id, 0)";
            $params = array(
                'username' => $username,
                'id' => $id
            );
            query($sqlString, $params);

        }
    }

    function removePendingTasks($pendingHomeworkClassID){
        $sqlString = "DELETE FROM pendinghomeworklist WHERE pendinghomeworkclassid = :phcd";
        $params = array('phcd' => $pendingHomeworkClassID);
        query($sqlString, $params);

        $sqlString = "DELETE FROM pendinghomeworkclass WHERE id = :id";
        $params = array('id' => $pendingHomeworkClassID);
        query($sqlString, $params);
    }

    function getNumberOfHomeworkItemsDone ($username) {
        $sqlString = "SELECT COUNT(*) AS homeworkItemsDone FROM pupilhomework WHERE username = :username AND isdone = 1";
        $params = array('username' => $username);
        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function getNumberOfHomeworkItems ($username) {
        $sqlString = "SELECT COUNT(*) AS homeworkItems FROM pupilhomework WHERE username = :username";
        $params = array('username' => $username);
        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function calculateHomeworkProgressForPupil ($username) {
        $homeworkItems = getNumberOfHomeworkItems($username)['homeworkItems'];
        if ($homeworkItems > 0) {
            return getNumberOfHomeworkItemsDone($username)['homeworkItemsDone'] / $homeworkItems * 100;
        } else {
            return 100;
        }
    }

    function combinePupilNameAndProgress ($classId) {
        $pupils = getPupils($classId);
        foreach ($pupils as &$pupil){
            $pupil['progress'] = calculateHomeworkProgressForPupil($pupil['username']);
        }
        return $pupils;
    }

    function getMainTeacherPupils () {

        $sqlString[] = array("etternavn" => "Fonnes", "fornavn" => "Simen");
        return $sqlString;
    }



    //CRUP

    //Create

    //Read
    function getMainTeacherClasses ($teacherName) {
        $sqlString = "SELECT * FROM classes
                          JOIN mainteachers
                          ON id = mainteachers.classid
                          WHERE username = :teacherName";
        $params = array('teacherName' => $teacherName);

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function getPupilsByClassId ($classId) {
        $sqlString = "SELECT * FROM users
                          WHERE classid = :classid";
        $params = array('classid' => $classId);

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    //Update
/*
    function updatePupil ($) {

    }

*/

    //Delete
    function deletePupil ($username) {
        $sqlString = "DELETE FROM users
                          WHERE username = :username";
        $params = array('username' => $username);
        query($sqlString, $params);
    }

    function getTeacher ($username) {
        $sqlString = "SELECT * FROM users
                          WHERE username = :username";
        $params = array('username' => $username);
        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function changePassword ($username, $currentPassword, $newPassword1, $newPassword2) {
        if (checkCurrentPassword($username, $currentPassword) && comparePasswords($newPassword1, $newPassword2)) {
            $sqlString = "UPDATE users
                          SET password = :newPassword1
                          WHERE username = :username AND password = :currentPassword";
            $params = array(
                'newPassword1' => $newPassword1,
                'username' => $username,
                'currentPassword' => $currentPassword
            );
            query($sqlString, $params);
        }
    }

    function checkCurrentPassword($username, $currentPassword) {
        $sqlString = "SELECT * FROM users WHERE username = :username AND password = :password";
        $params = array(
            'username' => $username,
            'password' => $currentPassword
        );
        return (query($sqlString, $params, DBI::FETCH_ONE) != null);
    }

    function comparePasswords ($newPassword1, $newPassword2) {
        return $newPassword1 === $newPassword2;
    }

    function changeEmail ($username, $email) {
        $sqlString = "UPDATE users
                          SET email = :email
                          WHERE username = :username";
        $params = array(
            'email' => $email,
            'username' => $username
        );
        query($sqlString, $params);
    }




//    function getClass($id){
//        global $database;
//        $sql = $database->prepare("SELECT * FROM classes WHERE id=:id");
//        $sql->execute(array(
//            'id' => $id
//        ));
//        return $sql->fetch(PDO::FETCH_ASSOC);
//    }
//
//    function getPupils($classID){
//        global $database;
//        $sql = $database->prepare("SELECT * FROM users WHERE classid=:classid");
//        $sql->execute(array(
//            'classid' => $classID
//        ));
//        return $sql->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//    function createUsers($id){
//        global $rootPath;
//        $class = getClass($id);
//        $users = preg_replace('~[\r\n]+~', '',$_POST['users'] );
//        $usernames = explode(';', trim($users));
//        include $rootPath.'/app/model/register.php';
//        foreach($usernames as $username){
//            if(isset($username))
//            registerUser($username, $username, null, 'pupil', $class['id'], $class['schoolid']);
//        }
//    }
//
//    function getClassSubjects($classID){
//        global $database;
//        $sql = $database->prepare("SELECT * FROM classsubjects JOIN subjects on subjects.id = subjectid WHERE classid=:classid");
//        $sql->execute(array(
//            'classid' => $classID
//        ));
//        return $sql->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//    function getAllSubjects(){
//        global $database;
//        $sql = $database->prepare("SELECT * FROM subjects");
//
//        $sql->execute();
//
//        return $sql->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//    function doAddSubject($classID){
//        global $database;
//        $sql = $database->prepare("INSERT INTO classsubjects VALUES(null, :classID, :subjectID)");
//
//        $sql->execute(array(
//           'classID' => $classID,
//            'subjectID' => $_POST['subjectid']
//        ));
//    }
//
//    function doGetClasses () {
//        global $database;
//        $sql = $database->prepare("SELECT * FROM classes");
//
//        $sql->execute();
//
//        return $sql->fetchAll(PDO::FETCH_ASSOC);
//    }
//
//    function doGetLearningObjects ($classId) {
//        global $database;
//        $sql = $database->prepare("SELECT * FROM classes JOIN favourites ON");
//
//        $sql->execute();
//
//        return $sql->fetchAll(PDO::FETCH_ASSOC);
//    }