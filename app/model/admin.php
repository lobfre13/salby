<?php

        function getSubjects(){
            global $database;
            $sql = $database->prepare("SELECT * FROM subjects");

            $sql->execute();

            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

       function doAddSubject(){
           global $database;
           $sql = $database->prepare("INSERT INTO subjects VALUES(null, :subjectname, :classlevel, :imgurl)");

           $sql->execute(array(
               'subjectname' => $_POST['subjectname'],
               'classlevel' => $_POST['classlevel'],
               'imgurl' => $_POST['imgurl']
           ));
       }

       function getSubject($id){
           global $database;
           $sql = $database->prepare("SELECT * FROM subjects WHERE id=:id");

           $sql->execute(array(
              'id' => $id
           ));
           return $sql->fetch(PDO::FETCH_ASSOC);
       }

        function getAllLearningObjects () {
            global $database;
            $sql = $database->prepare("SELECT * FROM learningobjects");

            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }


        function getCategories($subjectID){
            global $database;
            $sql = $database->prepare("SELECT * FROM categories JOIN subjectcategory on id = categoryid WHERE subjectid=:subjectid");

            $sql->execute(array(
               'subjectid' => $subjectID
            ));
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        function getAllCategories(){
            global $database;
            $sql = $database->prepare("SELECT *, categories.imgurl as catimg FROM categories
JOIN subjectcategory on categories.id = categoryid
JOIN subjects on subjectid = subjects.id");

            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

function getAllTheCategories()
{
    global $database;
    $sql = $database->prepare("SELECT * FROM categories JOIN subjectcategory on id = categoryid JOIN subjects on subjectid = subjects.id");

    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

        function doAddCategory($subjectID){
            global $database;
            $sql = $database->prepare("INSERT INTO categories VALUES(null, :categoryname, :imgurl)");

            $sql->execute(array(
               'categoryname' => $_POST['categoryname'],
                'imgurl' => $_POST['imgurl']
            ));
            $catID = $database->lastInsertId();
            $sql = $database->prepare("INSERT INTO subjectcategory VALUES(:subjectid, :categoryid)");

            $sql->execute(array(
               'subjectid' => $subjectID,
                'categoryid' => $catID
            ));
        }

        function doAddLObject(){
            global $database;
            $sql = $database->prepare("INSERT INTO learningobjects VALUES(null, :title, :url, :imgurl)");

            $sql->execute(array(
                'title' => $_POST['lobjecttitle'],
                'url' => $_POST['url'],
                'imgurl' => $_POST['imgurl']
            ));
            $lobjID = $database->lastInsertId();
            $sql = $database->prepare("INSERT INTO learningobjectcategory VALUES(:lobjectid, :categoryid)");

            $sql->execute(array(
                'lobjectid' => $lobjID,
                'categoryid' => $_POST['categoryid']
            ));
        }

        function getSchools () {
            global $database;
            $sql = $database->prepare("SELECT * FROM schools");

            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        function addSchool ($name, $fylke, $kommune) {
            global $database;
            $sql = $database->prepare("INSERT INTO schools (name, fylke, kommune) VALUES (:name, :fylke, :kommune)");

            $sql->execute(array(
                'name' => $name,
                'fylke' => $fylke,
                'kommune' => $kommune
            ));
        }

        //Search-operations
        function searchSchools ($searchString) {
            global $database;
            $sql = $database->prepare("SELECT * FROM schools WHERE name LIKE :searchString");

            $sql->execute(array(
                'searchString' => '%'.$searchString.'%'
            ));
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        function searchLearningObjects ($searchString) {
            global $database;
            $sql = $database->prepare("SELECT * FROM learningobjects WHERE title LIKE :searchString");

            $sql->execute(array(
                'searchString' => '%'.$searchString.'%'
            ));
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        function searchCategories ($searchString) {
            global $database;
            $sql = $database->prepare("SELECT *, categories.imgurl as catimg FROM categories
                                          JOIN subjectcategory on categories.id = categoryid
                                          JOIN subjects on subjectid = subjects.id WHERE category LIKE :searchString");

            $sql->execute(array(
                'searchString' => '%'.$searchString.'%'
            ));
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        function searchSubjects ($searchString) {
            global $database;
            $sql = $database->prepare("SELECT * FROM subjects WHERE subjectname LIKE :searchString");

            $sql->execute(array(
                'searchString' => '%'.$searchString.'%'
            ));
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

        //Update-operations
        function updateSchool ($name, $fylke, $kommune) {
            global $database;
            $sql = $database->prepare("UPDATE schools
                                        SET name = :name, fylke = :fylke, kommune = :kommune
                                        WHERE name = :name;");

            $sql->execute(array(
                'name' => $name,
                'fylke' => $fylke,
                'kommune' => $kommune
            ));
        }

        function updateSubject ($subjectName, $classLevel, $imgUrl) {
            global $database;
            $sql = $database->prepare("UPDATE subjects
                                        SET subjectname = :subjectName, classlevel = :classLevel, imgurl = :imgUrl
                                        WHERE subjectname = :subjectName;");

            $sql->execute(array(
                'subjectName' => $subjectName,
                'classLevel' => $classLevel,
                'imgUrl' => $imgUrl
            ));
        }

        function updateCategory ($category, $imgUrl) {
            global $database;
            $sql = $database->prepare("UPDATE categories
                                        SET category = :category, imgurl = :imgUrl
                                        WHERE category = :category;");

            $sql->execute(array(
                'category' => $category,
                'imgUrl' => $imgUrl
            ));
        }

        function updateLearningObject ($title, $link, $imgUrl) {
            global $database;
            $sql = $database->prepare("UPDATE learningobjects
                                                SET title = :title, link = :link, imgurl = :imgUrl
                                                WHERE title = :title;");

            $sql->execute(array(
                'title' => $title,
                'link' => $link,
                'imgUrl' => $imgUrl
            ));
        }

        //Delete-operations
        function deleteSchool ($schoolName) {
            global $database;
            $sql = $database->prepare("DELETE FROM schools WHERE name = :schoolName");

            $sql->execute(array(
                'schoolName' => $schoolName
            ));
        }

        function deleteSubject ($subjectName) {
            global $database;
            $sql = $database->prepare("DELETE FROM subjects WHERE subjectname = :subjectName");

            $sql->execute(array(
                'subjectName' => $subjectName
            ));
        }

        function deleteCategory ($categoryName) {
            global $database;
            $sql = $database->prepare("DELETE FROM categories WHERE category = :categoryName");

            $sql->execute(array(
                'categoryName' => $categoryName
            ));
        }

        function deleteLearningObject ($learningObjectName) {
            global $database;
            $sql = $database->prepare("DELETE FROM learningobjects WHERE title = :learningObjectName");

            $sql->execute(array(
                'learningObjectName' => $learningObjectName
            ));
        }


