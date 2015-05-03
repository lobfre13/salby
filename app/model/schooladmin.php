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
        $sqlString = "INSERT INTO users VALUES(:username, :password, :firstname, :lastname, :email, 'teacher', null, :schoolid)";
        $params = array(
            'username' => $username,
            'password' => $passowrd,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'schoolid' => $schoolid
        );

        query($sqlString, $params);

    }

    function addNewSchoolClass($schoolID, $className, $classLevel){
        $sqlString = "INSERT INTO classes VALUES(null, :schoolid, :classname, :classlevel)";
        $params = array(
            'schoolid' => $schoolID,
            'classname' => $className,
            'classlevel' => $classLevel
        );

        query($sqlString, $params);

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

    function addNewPupilToClass($schoolid, $classid, $firstname, $lastname){
        $username = substr($lastname, 0, 3).substr($firstname, 0,3);
        $sqlString = "INSERT INTO users VALUES(:username, :password, :firstname, :lastname, null, 'pupil', :classid, :schoolid)";
        $params = array(
            'username' => $username,
            'password' => $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'classid' => $classid,
            'schoolid' => $schoolid
        );

        query($sqlString, $params);


    }

    function getSchoolTeachers($schoolID){
        $sqlString = "SELECT * FROM users WHERE schoolid=:schoolid AND role=:role";
        $params = array(
            'schoolid' => $schoolID,
            'role' => 'teacher'
        );

        return query($sqlString, $params, DBI::FETCH_ALL);


    }

    function updateMainTeacher($classid, $username){
        $sqlString = "DELETE FROM mainteachers WHERE classid = :classid";
        $params = array('classid' => $classid);
        query($sqlString, $params);
        $sqlString = "INSERT INTO mainteachers VALUES(:username, :classid)";
        $params = array('username' => $username, 'classid' => $classid);
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
function getSchoolClasses($schoolID)
{
    global $database;
    $sql = $database->prepare("SELECT * FROM classes " .
        "LEFT JOIN mainteachers ON id = classid " .
        "WHERE schoolid=:schoolid");

    $sql->execute(array(
        'schoolid' => $schoolID
    ));
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

function searchClasses($searchString)
{
    $sqlString = "SELECT * FROM schools WHERE name LIKE :searchString";
    $params = array(
        'searchString' => '%' . $searchString . '%'
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