<?php
    include_once 'dbInterface.php';

    function getSchoolID($username){
        $sqlString = "SELECT * FROM users WHERE username=:username";
        $params = array(
            'username' => $username
        );

        return query($sqlString, $params, DBI::FETCH_ONE)['schoolid'];
    }

    function getSchool($schoolID){
        $sqlString = "SELECT * FROM schools WHERE id=:id";
        $params = array(
            'id' => $schoolID
        );

        return query($sqlString, $params, DBI::FETCH_ONE);

    }

        function getSchoolUser($username){
            $sqlString = "SELECT * FROM users WHERE username = :username";
            $params = array(
                'username' => $username
            );

            return query($sqlString, $params, DBI::FETCH_ONE);

    }

    function getClassesInLevel($schoolID, $classLevel){
        $sqlString = "SELECT * FROM classes
                      LEFT JOIN mainteachers ON id = classid
                      WHERE schoolid=:schoolid AND classlevel = :classlevel";
        $params = array(
            'schoolid' => $schoolID,
            'classlevel' => $classLevel
        );

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function registerTeacher($firstname, $lastname, $email, $username, $passowrd, $schoolid){
        $sqlString = "INSERT INTO users VALUES(:username, :password, :firstname, :lastname, :email, 'teacher', null, :schoolid)
                      ON DUPLICATE KEY UPDATE username = username";
        $params = array(
            'username' => $username,
            'password' => $passowrd,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'schoolid' => $schoolid
        );

        if(query($sqlString, $params, DBI::ROW_COUNT))
           $_SESSION['notice'] = "Lærerbrukeren ble opprettet!";
        else
            $_SESSION['error'] = "Brukernavnet du valgte er opptatt";
    }

    function addNewSchoolClass($schoolID, $className, $classLevel){
        $sqlString = "INSERT INTO classes VALUES(null, :schoolid, :classname, :classlevel)";
        $params = array(
            'schoolid' => $schoolID,
            'classname' => $className,
            'classlevel' => $classLevel
        );

        $classId = query($sqlString, $params, DBI::LAST_ID);
        addSubjectsToClass($classId, $classLevel);
        if($classId)
            $_SESSION['notice'] = "Klassen ble opprettet!";
        else
            $_SESSION['error'] = "En feil har oppstått";
    }

    function addSubjectsToClass($classId, $classLevel){
        $subjects = getAllTheSubjects($classLevel);
        $sqlString = "INSERT INTO classsubjects VALUES(null, :classId, :subjectId)";

        foreach ($subjects as $subject){
            $params = array('classId' => $classId, 'subjectId' => $subject['id']);
            query($sqlString, $params);
        }
    }
    function getAllTheSubjects($classLevel){
        $sqlString = "SELECT * FROM subjects WHERE classlevel = :classLevel";
        $params = array('classLevel' => $classLevel);

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function getMainTeacher($classID){
        $sqlString = "SELECT * FROM mainteachers
                      JOIN users ON users.username = mainteachers.username
                      WHERE mainteachers.classid = :classid";
        $params = array(
            'classid' => $classID
        );

        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function usernameTaken($username){
        $sqlString = "SELECT * FROM users WHERE username = :username";
        $params = array('username' => $username);
        return query($sqlString, $params, DBI::ROW_COUNT) > 0;
    }

    function addNewPupilToClass($schoolid, $classid, $firstname, $lastname){
        $OrigUsername = substr($lastname, 0, 3).substr($firstname, 0,3);
        $username = $OrigUsername;
        $i = 1;
        while(usernameTaken($username)){
            $username = $OrigUsername.$i++;
        }
        $sqlString = "INSERT INTO users VALUES(:username, :password, :firstname, :lastname, null, 'pupil', :classid, :schoolid)
                      ON DUPLICATE KEY UPDATE username = username";
        $params = array(
            'username' => $username,
            'password' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'classid' => $classid,
            'schoolid' => $schoolid
        );

        if(query($sqlString, $params, DBI::ROW_COUNT))
            $_SESSION['notice'] = "Eleven ble opprettet";
        else
            $_SESSION['error'] = "En feil har oppstått";
    }

    function getSchoolTeachers($schoolID){
        $sqlString = "SELECT * FROM users WHERE schoolid=:schoolid AND role=:role";
        $params = array(
            'schoolid' => $schoolID,
            'role' => 'teacher'
        );

        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function updateMainTeacher($classId, $username){
        $classes = getClassSubjects($classId);

        $sqlString = "DELETE FROM mainteachers WHERE classid = :classid";
        $params = array('classid' => $classId);
        query($sqlString, $params);

        $sqlString = "INSERT INTO mainteachers VALUES(:username, :classId)";
        $params = array('username' => $username, 'classId' => $classId);
        if(query($sqlString, $params, DBI::ROW_COUNT))
            $_SESSION['notice'] = "Kontaktlærer oppdatert";
        else
            $_SESSION['error'] = "En feil har oppstått";

        $sqlString2 = "DELETE FROM classsubjectteachers WHERE classsubjectid = :classsubjectId";
        $sqlString = "INSERT INTO classsubjectteachers VALUES(:username, :classsubjectId)";
        foreach($classes as $class){
            $params2 = array('classsubjectId' => $class['id']);
            $params = array('username' => $username, 'classsubjectId' => $class['id']);
            query($sqlString2, $params2);
            query($sqlString, $params);
        }
    }

    function getClassSubjects($classId){
        $sqlString = "SELECT * FROM classsubjects where classid = :classId";
        $params = array('classId' => $classId);
        return query($sqlString, $params, DBI::FETCH_ALL);
    }

    function deleteSchoolClass($classId){
        $sqlString = "DELETE FROM classes WHERE id = :classId";
        $params = array('classId' => $classId);
        query($sqlString, $params);
    }

    function getSchoolClass($classId){
        $sqlString = "SELECT * FROM classes WHERE id = :classId";
        $params = array('classId' => $classId);
        return query($sqlString, $params, DBI::FETCH_ONE);
    }

    function deletePupilUser($username, $schoolId){
        $sqlString = "DELETE FROM users WHERE username = :username AND schoolid = :schoolId";
        $params = array('username' => $username, 'schoolId' => $schoolId);
        query($sqlString, $params);
    }

//    function getRegkey($schoolID){
//        global $database;
//        $sql = $database->prepare("SELECT * FROM schools WHERE id=:id");
//
//        $sql->execute(array(
//            'id' => $schoolID
//        ));
//        return $sql->fetch(PDO::FETCH_ASSOC)['regkey'];
//    }
//
    function getSchoolClasses($schoolID){
        global $database;
        $sql = $database->prepare("SELECT * FROM classes " .
            "LEFT JOIN mainteachers ON id = classid " .
            "WHERE schoolid=:schoolid");

        $sql->execute(array(
            'schoolid' => $schoolID
        ));
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    function searchClasses($schoolId, $searchString){
        $sqlString = "SELECT * FROM classes WHERE classname LIKE :searchString AND schoolid = :schoolId";
        $params = array(
            'searchString' => '%' . $searchString . '%',
            'schoolId' => $schoolId
        );
        return query($sqlString, $params, DBI::FETCH_ALL);

    }
//
//
//
//    function doCreateSchoolClass($schoolID){
//        global $database;
//        $sql = $database->prepare("INSERT INTO classes VALUES(null, :schoolid, :classname, :classlevel)");
//
//        $sql->execute(array(
//            'schoolid' => $schoolID,
//            'classname' => $_POST['classname'],
//            'classlevel' => $_POST['classlevel']
//        ));
//        $classID = $database->lastInsertId();
//
//        $sql = $database->prepare("INSERT INTO mainteachers VALUES(:username, :classid)");
//
//        $sql->execute(array(
//           'username' => $_POST['mainteacher'],
//            'classid' => $classID
//        ));
//    }