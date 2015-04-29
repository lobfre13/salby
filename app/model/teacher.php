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

        return query($sqlString, $params, 1);

        /*global $database;
        $sql = $database->prepare("SELECT c.classname, c.classlevel, s.subjectname, cs.id, cs.subjectid FROM classes as c
                                  JOIN classsubjects as cs ON cs.classid = c.id
                                  JOIN classsubjectteachers as cst ON cst.classsubjectid = cs.id
                                  JOIN subjects as s ON s.id = cs.subjectid
                                  WHERE cst.username = :username
                                  ORDER BY c.classlevel, c.classname");

        $sql->execute(array(
            'username' => $username
        ));

        return $sql->fetchAll(PDO::FETCH_ASSOC);*/
    }

    function getClassPupils($classID){
        $sqlString = "SELECT * FROM users
                      WHERE classid = :classid";
        $params = array(
            'classid' => $classID
        );

        return query($sqlString, $params, 1);

        /*global $database;
        $sql = $database->prepare("SELECT * FROM users
                                   WHERE classid = :classid");
        $sql->execute(array(
            'classid' => $classID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);*/
    }

    function getClassTasks($classID){
        $sqlString = "SELECT lo.title, h.duedate, h.url, h.id FROM learningobjects as lo
                                   JOIN homework as h ON h.learningobjectid = lo.id
                                   JOIN classsubjects as cs ON cs.id = h.classsubjectid
                                   WHERE cs.classid = :classid";
        $params = array(
            'classid' => $classID
        );

        return query($sqlString, $params, 1);
        /*global $database;
        $sql = $database->prepare("SELECT lo.title, h.duedate, h.url, h.id FROM learningobjects as lo
                                   JOIN homework as h ON h.learningobjectid = lo.id
                                   JOIN classsubjects as cs ON cs.id = h.classsubjectid
                                   WHERE cs.classid = :classid");
        $sql->execute(array(
            'classid' => $classID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);*/
    }

    function getClassTask($taskID){
        $sqlString = "SELECT duedate, title, homework.id FROM homework
                                    JOIN learningobjects as lo ON lo.id = learningobjectid
                                    WHERE homework.id = :taskid";
        $params = array(
            'taskid' => $taskID
        );

        return query($sqlString, $params, 2);
        /*global $database;
        $sql = $database->prepare("SELECT duedate, title, homework.id FROM homework
                                    JOIN learningobjects as lo ON lo.id = learningobjectid
                                    WHERE homework.id = :taskid");
        $sql->execute(array(
            'taskid' => $taskID
        ));
        return $sql->fetch(PDO::FETCH_ASSOC);*/
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
        /*global $database;
        $sql = $database->prepare("UPDATE homework
                                   SET duedate = :duedate
                                   WHERE id = :id");
        $sql->execute(array(
            'duedate' => $date,
            'id' => $taskid
        ));*/
    }

    function deleteClassTask($taskID){
        $sqlString = "DELETE FROM pupilhomework WHERE homeworkid = :id";
        $params = array('id' => $taskID);
        query($sqlString, $params);

        $sqlString = "DELETE FROM homework WHERE id = :id";
        query($sqlString, $params);

        /*global $database;
        $sql = $database->prepare("DELETE FROM pupilhomework WHERE homeworkid = :id");
        $sql->execute(array('id' => $taskID));

        $sql = $database->prepare("DELETE FROM homework WHERE id = :id");
        $sql->execute(array('id' => $taskID));*/
    }

    function addPendingTask($taskID, $username, $classSubjectID){
        $pendingHomeworkClassID = getPendingHomeworkClassID($username, $classSubjectID);
        $sqlString = "INSERT INTO pendinghomeworklist VALUES(:taskid, :phcid)";
        $params = array(
            'taskid' => $taskID,
            'phcid' => $pendingHomeworkClassID
        );

        return query($sqlString, $params, 1);

        /*$pendingHomeworkClassID = getPendingHomeworkClassID($username, $classSubjectID);
        global $database;
        $sql = $database->prepare("INSERT INTO pendinghomeworklist VALUES(:taskid, :phcid)");
        $sql->execute(array(
            'taskid' => $taskID,
            'phcid' => $pendingHomeworkClassID
        ));*/
    }

    function getPendingHomeworkClassID($username, $classSubjectID){
        $sqlString = "SELECT * FROM pendinghomeworkclass WHERE classsubjectid = :csid AND username = :username";
        $params = array(
            'csid' => $classSubjectID,
            'username' => $username
        );

        return query($sqlString, $params, 2)['id'];
        /*global $database;
        $sql = $database->prepare("SELECT * FROM pendinghomeworkclass WHERE classsubjectid = :csid AND username = :username");

        $sql->execute(array(
            'csid' => $classSubjectID,
            'username' => $username
        ));
        if($sql->rowCount() == 0) return getNewPendingHomeworkEntryID($username, $classSubjectID);
        return $sql->fetch(PDO::FETCH_ASSOC)['id'];*/
    }

    function getNewPendingHomeworkEntryID($username, $classSubjectID){
        $sqlString = "INSERT INTO pendinghomeworkclass VALUES(null, :csid, :username)";
        $params = array(
            'csid' => $classSubjectID,
            'username' => $username
        );
        query($sqlString, $params);
        global $database;
        return $database->lastInsertId();

        /*$sql = $database->prepare("INSERT INTO pendinghomeworkclass VALUES(null, :csid, :username)");
        $sql->execute(array(
            'csid' => $classSubjectID,
            'username' => $username
        ));*/

    }

    function getPendingTasks($subjectID, $username){
        $sqlString = "SELECT * FROM pendinghomeworklist
                                   JOIN learningobjects as lo ON lo.id = learningobjectid
                                   JOIN pendinghomeworkclass as phc ON phc.id = pendinghomeworkclassid
                                   WHERE phc.username = :username AND phc.classsubjectid = :csid";
        $params = array('csid' => $subjectID, 'username' => $username);
        return query($sqlString, $params, 1);

        /*global $database;
        $sql = $database->prepare("SELECT * FROM pendinghomeworklist
                                   JOIN learningobjects as lo ON lo.id = learningobjectid
                                   JOIN pendinghomeworkclass as phc ON phc.id = pendinghomeworkclassid
                                   WHERE phc.username = :username AND phc.classsubjectid = :csid");
        $sql->execute(array('csid' => $subjectID, 'username' => $username));
        return $sql->fetchAll(PDO::FETCH_ASSOC);*/
    }

    function getPupils($classSubjectID){
        $sqlString = "SELECT * FROM users
                      JOIN classes  as c ON c.id = users.classid
                      JOIN classsubjects as cs ON cs.classid = c.id
                      WHERE cs.id = :classsubjectid";
        $params = array(
            'classsubjectid' => $classSubjectID
        );

        return query($sqlString, $params, 1);
        /*global $database;
        $sql = $database->prepare("SELECT * FROM users
                                   JOIN classes  as c ON c.id = users.classid
                                   JOIN classsubjects as cs ON cs.classid = c.id
                                   WHERE cs.id = :classsubjectid");
        $sql->execute(array(
           'classsubjectid' => $classSubjectID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);*/
    }

    function getPupilsFromUsername($usernames){
        if(count($usernames) < 1) return null;
        global $database;
        $qMarks = str_repeat('?,', count($usernames) - 1) . '?';

        $sqlString = "SELECT * FROM users WHERE username in(" . $qMarks . ")";
        return query($sqlString, $usernames, 1);
        /*$sql = $database->prepare("SELECT * FROM users WHERE username in(".$qMarks.")");
        $sql->execute($usernames);
        return $sql->fetchAll(PDO::FETCH_ASSOC);*/
    }

    function addHomework($pendingTasks, $pupilUsernames, $classid){
        global $database;
        foreach($pendingTasks as $task){
            $sqlString = "INSERT INTO homework VALUES(null, :csid, :taskid, null, '/forside/fag/1-klasse/norsk/mockURL/" . $task['title'] . "')";
            $params = array(
                'csid' => $classid,
                'taskid' => $task['learningobjectid']
            );
            query($sqlString, $params);

            /*$sql = $database->prepare("INSERT INTO homework VALUES(null, :csid, :taskid, null, '/forside/fag/1-klasse/norsk/mockURL/".$task['title']."')");
            $sql->execute(array(
                'csid' => $classid,
               'taskid' => $task['learningobjectid']
            ));*/
            $id = $database->lastInsertId();
            addPupilToHomework($pupilUsernames, $id);
        }
    }

    function addPupilToHomework($pupilUsernames, $id){
        global $database;
        foreach($pupilUsernames as $username){
            $sqlString = "INSERT INTO pupilhomework VALUES(:username, :id, 0)";
            $params = array(
                'username' => $username,
                'id' => $id
            );
            query($sqlString, $params);
            /*$sql = $database->prepare("INSERT INTO pupilhomework VALUES(:username, :id, 0)");
            $sql->execute(array(
                'username' => $username,
                'id' => $id
            ));*/
        }
    }

    function removePendingTasks($pendingHomeworkClassID){
        $sqlString = "DELETE FROM pendinghomeworklist WHERE pendinghomeworkclassid = :phcd)";
        $params = array('phcd' => $pendingHomeworkClassID);
        query($sqlString, $params);

        $sqlString = "DELETE FROM pendinghomeworkclass WHERE id = :id";
        $params = array('id' => $pendingHomeworkClassID);
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