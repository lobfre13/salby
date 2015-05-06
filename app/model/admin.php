<?php
    include_once 'dbInterface.php';

    function getAllSubjects(){
        $sqlString = "SELECT * FROM subjects";
        $params = array();
        return query($sqlString, $params, DBI::FETCH_ALL);
    }

function getSubjectFromID($id)
{
    $sqlString = "SELECT * FROM subjects WHERE id=:id";
    $params = array(
        'id' => $id
    );

    return query($sqlString, $params, DBI::FETCH_ONE);
}

function getCategoryFromID($categoryid)
{
    $sqlString = "SELECT * FROM categories
                              WHERE id = :categoryid";
    $params = array('categoryid' => $categoryid);
    return query($sqlString, $params, DBI::FETCH_ONE);
}

function getAllLearningObjects()
{
    $sqlString = "SELECT * FROM learningobjects";
    $params = array();
    return query($sqlString, $params, DBI::FETCH_ALL);
}

function getCategories($subjectID)
{
    $sqlString = "SELECT * FROM categories JOIN subjectcategory on id = categoryid WHERE subjectid=:subjectid";
    $params = array(
        'subjectid' => $subjectID
    );
    $result = query($sqlString, $params, DBI::FETCH_ALL);
    for ($i = 0; $i < count($result); $i++) {
        $result = array_merge($result, getSubCategories($result[$i]['id']));
    }
    return $result;
}

function getAllCategories()
{
    $sqlString = "SELECT *, categories.imgurl as catimg, categories.id as catid FROM categories
                              LEFT JOIN subjectcategory on categories.id = categoryid
                              LEFT JOIN subjects on subjectid = subjects.id
                              GROUP BY catid";
    $params = array();
    return query($sqlString, $params, DBI::FETCH_ALL);
}

function getSchools()
{
    $sqlString = "SELECT * FROM schools";
        $params = array();
    return query($sqlString, $params, DBI::FETCH_ALL);
}

function addSchool($name, $fylke, $kommune)
{
    $sqlString = "INSERT INTO schools (name, fylke, kommune) VALUES (:name, :fylke, :kommune)";
    $params = array(
        'name' => $name,
        'fylke' => $fylke,
        'kommune' => $kommune
    );
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Skolen ble lagt til!";
    else
        $_SESSION['error'] = "En feil har oppstått";
}

function addLearningObject($lOnavn)
{
    $lObjectUrl = explode(".", uploadAndExtractZIP())[0];
    $sqlString = "INSERT INTO learningobjects  VALUES (null, :lOnavn, :lObject, :icon)";
    $params = array(
        'lOnavn' => $lOnavn,
        'icon' => '/public/lobjects/' . $lObjectUrl . '/icon.png',
        'lObject' => '/public/lobjects/' . $lObjectUrl . '/index.html'
    );
    if (query($sqlString, $params, DBI::ROW_COUNT) && $lObjectUrl)
        $_SESSION['notice'] = "Læringsobjektet ble lagt til!";
    else
        $_SESSION['error'] = "En feil har oppstått";
}

//    //Search-operations
function searchSchools($searchString)
{
    $sqlString = "SELECT * FROM schools WHERE name LIKE :searchString";
    $params = array(
        'searchString' => '%' . $searchString . '%'
    );
    return query($sqlString, $params, DBI::FETCH_ALL);
}

function searchLearningObjects($searchString)
{
    $sqlString = "SELECT * FROM learningobjects WHERE title LIKE :searchString";
    $params = array(
        'searchString' => '%' . $searchString . '%'
    );
    return query($sqlString, $params, DBI::FETCH_ALL);
}

function searchCategories($searchString)
{
    $sqlString = "SELECT *, categories.imgurl as catimg FROM categories
                              JOIN subjectcategory on categories.id = categoryid
                              JOIN subjects on subjectid = subjects.id WHERE category LIKE :searchString";
    $params = array(
        'searchString' => '%' . $searchString . '%'
    );
        return query($sqlString, $params, DBI::FETCH_ALL);
    }

function searchSubjects($searchString)
{
    $sqlString = "SELECT * FROM subjects WHERE subjectname LIKE :searchString";
        $params = array(
            'searchString' => '%' . $searchString . '%'
        );
    return query($sqlString, $params, DBI::FETCH_ALL);
    }

//    //Update-operations
function updateSchool($schoolid, $name, $fylke, $kommune)
{
    $sqlString = "UPDATE schools
                              SET name = :name,
                              fylke = :fylke,
                              kommune = :kommune
                              WHERE id = :schoolid;";
    $params = array(
        'name' => $name,
        'fylke' => $fylke,
        'kommune' => $kommune,
        'schoolid' => $schoolid
    );
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Skole oppdatert!";
    else
        $_SESSION['error'] = "En feil har oppstått";
}

//    //Delete-operations
function deleteSchool($schoolId)
{
    $sqlString = "DELETE FROM schools WHERE id = :schoolId";
    $params = array(
        'schoolId' => $schoolId
    );
    query($sqlString, $params);
}

function deleteSubject($subjectID)
{
    $sqlString = "DELETE FROM subjects WHERE id = :subjectId";
    $params = array(
        'subjectId' => $subjectID
    );
    query($sqlString, $params);
}

function deleteCategory($categoryId)
{
    $sqlString = "DELETE FROM categories WHERE id = :categoryId";
    $params = array(
        'categoryId' => $categoryId
    );
    query($sqlString, $params);
}

function deleteLearningObject($learningObjectId)
{
    $sqlString = "DELETE FROM learningobjects WHERE id = :learningObjectId";
        $params = array(
            'learningObjectId' => $learningObjectId
        );
    query($sqlString, $params);
}

//
function deletelObjectRelation($catID, $lObjectID)
{
    $sqlStrring = "DELETE FROM learningobjectcategory WHERE learningobjectid = :lobjectid AND categoryid = :catid";
    $params = array(
        'lobjectid' => $lObjectID,
        'catid' => $catID
    );
    query($sqlStrring, $params);
}

function deleteCategoryRelation($subjectID, $categoryID)
{
    $sqlString = "DELETE FROM subjectcategory WHERE categoryid = :categoryid AND subjectid = :subjectid";
    $params = array(
        'categoryid' => $categoryID,
        'subjectid' => $subjectID
    );
    query($sqlString, $params);
}

function deleteParentCategoryRelation($categoryid)
{
    $sqlString = "UPDATE categories SET parentid = 0 WHERE id = :categoryid";
    $params = array('categoryid' => $categoryid);
    query($sqlString, $params);
}

function deleteUser($username)
{
    $sqlString = "DELETE FROM users WHERE username = :username";
    $params = array('username' => $username);
    query($sqlString, $params);
}

//    //Edit-operation
function getlObjectRelation($lObjectID)
{
    $sqlString = "SELECT *, categories.id as catid FROM learningobjectcategory
                              JOIN categories ON categoryid = categories.id
                              LEFT JOIN subjectcategory ON subjectcategory.categoryid = categories.id
                              LEFT JOIN subjects ON subjects.id = subjectid
                              WHERE learningobjectid = :lobjectid";
    $params = array('lobjectid' => $lObjectID);
    return query($sqlString, $params, DBI::FETCH_ALL);
}

//
function addlObjectRelation($lObjectID, $categoryID)
{
    $sqlString = "INSERT INTO learningobjectcategory VALUES(:lobjectid, :categoryid)";
    $params = array(
        'lobjectid' => $lObjectID,
        'categoryid' => $categoryID
    );
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Læringsobjektrelasjonen ble lagt til!";
    else
        $_SESSION['error'] = "Relasjonen finnes allerede";
}

function updateLObject($lObjectID, $title)
{
    if ($_FILES["zip_file"]["name"]) {
        $lObjectUrl = explode(".", uploadAndExtractZIP())[0];

        $sqlString = "UPDATE learningobjects SET title = :title, imgurl = :icon, link = :link WHERE id = :lobjectid";
        $params = array(
            'title' => $title,
            'icon' => '/public/lobjects/' . $lObjectUrl . '/icon.png',
            'link' => '/public/lobjects/' . $lObjectUrl . '/index.html',
            'lobjectid' => $lObjectID
        );
    } else {
        $sqlString = "UPDATE learningobjects SET title = :title WHERE id = :lobjectid";
        $params = array('title' => $title, 'lobjectid' => $lObjectID);
    }

    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Læringsobjektet ble oppdatert!";
    else
        $_SESSION['error'] = "En feil har oppstått";
}

function getCategoryRelations($categoryID)
{
    $sqlString = "SELECT * FROM subjectcategory
                              JOIN subjects ON id = subjectid
                              WHERE categoryid = :categoryid";
    $params = array('categoryid' => $categoryID);
    return query($sqlString, $params, DBI::FETCH_ALL);
}

function updateCategory($categoryID, $title, $icon)
{
    $sqlString = "UPDATE categories SET category = :title, imgurl = :icon WHERE id = :categoryid";
    $params = array(
        'title' => $title,
        'icon' => $icon,
        'categoryid' => $categoryID
    );
    query($sqlString, $params);
}

function addCategoryRelation($categoryID, $subjectID, $parentCategoryID)
{
    if (isset($parentCategoryID) && !empty($parentCategoryID)) {
        $sqlString = "UPDATE categories SET parentid = :parentid WHERE id = :categoryid";
        $params = array('parentid' => $parentCategoryID, 'categoryid' => $categoryID);
    } else {
        $sqlString = "INSERT INTO subjectcategory VALUES(:subjectid, :categoryid)";
        $params = array(
            'categoryid' => $categoryID,
            'subjectid' => $subjectID
        );
    }
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Kategorirelasjon ble lagt til!";
    else
        $_SESSION['error'] = "Relasjonen finnes fra før";
}

function getSchoolUsers($schoolID)
{
    $sqlString = "SELECT * FROM users WHERE role = 'school' AND schoolid = :schoolid";
    $params = array('schoolid' => $schoolID);
    return query($sqlString, $params, DBI::FETCH_ALL);
}

function addSchoolUser($schoolid, $username, $password, $email)
{
    $sqlString = "INSERT INTO users VALUES (:username, :password, null, null, :email, 'school', null, :schoolid)
                      ON DUPLICATE KEY UPDATE username = username";
    $params = array(
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'schoolid' => $schoolid
    );
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Skolebruker opprettet!";
    else
        $_SESSION['error'] = "Brukernavnet er opptatt";
}

function getAdmin($username)
{
    $sqlString = "SELECT * FROM users WHERE username = :username";
    $params = array('username' => $username);
        return query($sqlString, $params, DBI::FETCH_ONE);
}

////http://www.w3schools.com/php/php_file_upload.asp downloaded 10/Mar/2014
function picUpload($root)
{
    if (!empty($_FILES["pic"]["name"])) {
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $temp = explode(".", $_FILES["pic"]["name"]);
        $extension = end($temp);
        if ((($_FILES["pic"]["type"] == "image/gif")
                || ($_FILES["pic"]["type"] == "image/jpeg")
                || ($_FILES["pic"]["type"] == "image/jpg")
                || ($_FILES["pic"]["type"] == "image/png"))
            && ($_FILES["pic"]["size"] < 20000000)
            && in_array($extension, $allowedExts)
        ) {

            if (!($_FILES["pic"]["error"] > 0)) {
                move_uploaded_file($_FILES["pic"]["tmp_name"], $root . "/public/img/" . $_FILES["pic"]["name"]);
                return $_FILES["pic"]["name"];
            }
        }
    }
    return false;
    }

//
function addNewSubject($subjectName, $classLevel, $fileName)
{
    $imgUrl = generateImgUrl($fileName);

    $sqlString = "INSERT INTO subjects (subjectname, classlevel, imgurl)
                      VALUES (:subjectName, :classLevel, :imgUrl)";
    $params = array(
        'subjectName' => $subjectName,
        'classLevel' => $classLevel,
        'imgUrl' => $imgUrl
    );
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Faget ble lagt til!";
    else
        $_SESSION['error'] = "En feil har oppstått";
    }

function addNewCategory($categoryName, $fileName)
{
    $imgUrl = generateImgUrl($fileName);

    $sqlString = "INSERT INTO categories (category, imgurl, parentid)
                      VALUES (:categoryName, :imgUrl, null)";
    $params = array(
        'categoryName' => $categoryName,
        'imgUrl' => $imgUrl
    );
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Kategorien ble lagt til!";
    else
        $_SESSION['error'] = "En feil har oppstått";
    }

function editSubject($subjectId, $subjectName, $classLevel, $fileName)
{
    if (isset($fileName) && !empty($fileName)) {
        $imgUrl = generateImgUrl($fileName);

        $sqlString = "UPDATE subjects
                      SET subjectname = :subjectName,
                      classlevel = :classLevel,
                      imgurl = :imgUrl
                      WHERE id = :subjectId";
        $params = array(
            'subjectName' => $subjectName,
            'classLevel' => $classLevel,
            'imgUrl' => $imgUrl,
            'subjectId' => $subjectId
        );
    } else {
        $sqlString = "UPDATE subjects
                      SET subjectname = :subjectName,
                      classlevel = :classLevel
                      WHERE id = :subjectId";
        $params = array(
            'subjectName' => $subjectName,
            'classLevel' => $classLevel,
            'subjectId' => $subjectId
        );
        }
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Fag oppdatert!";
    else
        $_SESSION['error'] = "En feil har oppstått";
    }

function editCategory($categoryId, $categoryName, $fileName)
{
    if (isset($fileName) && !empty($fileName)) {
        $imgUrl = generateImgUrl($fileName);

        $sqlString = "UPDATE categories
                      SET category = :categoryName,
                      imgurl = :imgUrl
                      WHERE id = :categoryId";
        $params = array(
            'categoryName' => $categoryName,
            'imgUrl' => $imgUrl,
            'categoryId' => $categoryId
        );
    } else {
        $sqlString = "UPDATE categories
                      SET category = :categoryName
                      WHERE id = :categoryId";
        $params = array(
            'categoryName' => $categoryName,
            'categoryId' => $categoryId
        );
    }
    if (query($sqlString, $params, DBI::ROW_COUNT))
        $_SESSION['notice'] = "Kategorien ble oppdatert";
    else
        $_SESSION['error'] = "En feil har oppstått";
    }

function generateImgUrl($fileName)
{
    return '/public/img/' . $fileName;
    }

////http://bavotasan.com/2010/how-to-upload-zip-file-using-php/

function uploadAndExtractZIP()
{
    if ($_FILES["zip_file"]["name"]) {
        $filename = $_FILES["zip_file"]["name"];
        $source = $_FILES["zip_file"]["tmp_name"];
        $type = $_FILES["zip_file"]["type"];

        $name = explode(".", $filename);
        $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
        foreach ($accepted_types as $mime_type) {
            if ($mime_type == $type) {
                $okay = true;
                break;
            }
        }

        $continue = strtolower($name[1]) == 'zip' ? true : false;
        if (!$continue) {
            return false;
        }

        $target_path = "/var/www/public/lobjects/" . $filename;
        delete(substr($target_path, 0, -4));
        if (move_uploaded_file($source, $target_path)) {
            $zip = new ZipArchive();
            $x = $zip->open($target_path);
            if ($x === true) {
                $zip->extractTo("/var/www/public/lobjects/");
                $zip->close();

                unlink($target_path);
            }
        } else {
            return false;
        }
        return $_FILES["zip_file"]["name"];
    } else return false;
    }

//http://stackoverflow.com/questions/1334398/how-to-delete-a-folder-with-contents-using-php
    function delete($path){
        if (is_dir($path) === true) {
            $files = array_diff(scandir($path), array('.', '..'));
            foreach ($files as $file) {
                delete(realpath($path) . '/' . $file);
            }
            return rmdir($path);
        }

        else if (is_file($path) === true) {
            return unlink($path);
        }
        return false;
    }