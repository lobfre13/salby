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
            $sql = $database->prepare("SELECT * FROM categories JOIN subjectcategory on id = categoryid JOIN subjects on subjectid = subjects.id");

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
            $sql = $database->prepare("SELECT * FROM categories WHERE category LIKE :searchString");

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
