<?php

    include_once 'dbInterface.php';

        function getSubjects(){
            $sqlString = "SELECT * FROM subjects";
            $params = array();
            return query($sqlString, $params, DBI::FETCH_ALL);
        }

       function doAddSubject(){
           $sqlString = "INSERT INTO subjects VALUES(null, :subjectname, :classlevel, :imgurl)";
           $params = array(
               'subjectname' => $_POST['subjectname'],
               'classlevel' => $_POST['classlevel'],
               'imgurl' => $_POST['imgurl']
           );
           query($sqlString, $params);

       }

       function getSubject($id){
           $sqlString = "SELECT * FROM subjects WHERE id=:id";
           $params = array(
               'id' => $id
           );
           return  query($sqlString, $params, DBI::FETCH_ONE);

       }

        function getAllLearningObjects () {
            $sqlString = "SELECT * FROM learningobjects";
            $params = array();
            return query($sqlString, $params, DBI::FETCH_ALL);

        }


        function getCategories($subjectID){
            $sqlString = "SELECT * FROM categories JOIN subjectcategory on id = categoryid WHERE subjectid=:subjectid";
            $params = array(
                'subjectid' => $subjectID
            );
            return query($sqlString, $params, DBI::FETCH_ALL);

        }

        function getAllCategories(){
            $sqlString = "SELECT *, categories.imgurl as catimg FROM categories
                          JOIN subjectcategory on categories.id = categoryid
                          JOIN subjects on subjectid = subjects.id";
            $params = array();
            return query($sqlString, $params, DBI::FETCH_ALL);
        }

        function getAllTheCategories(){
            $sqlString = "SELECT * FROM categories JOIN subjectcategory on id = categoryid JOIN subjects on subjectid = subjects.id";
            $params = array();
            return query($sqlString, $params, DBI::FETCH_ALL);

        }

        function doAddCategory($subjectID){
            $sqlString = "INSERT INTO categories VALUES(null, :categoryname, :imgurl)";
            $params = array(
                'categoryname' => $_POST['categoryname'],
                'imgurl' => $_POST['imgurl']
            );
            $catID = query($sqlString, $params, DBI::LAST_ID);

            $sqlString = "INSERT INTO subjectcategory VALUES(:subjectid, :categoryid)";
            $params = array(
                'subjectid' => $subjectID,
                'categoryid' => $catID
            );
            query($sqlString, $params);

        }

        function doAddLObject(){
            $sqlString = "INSERT INTO learningobjects VALUES(null, :title, :url, :imgurl)";
            $params = array(
                'title' => $_POST['lobjecttitle'],
                'url' => $_POST['url'],
                'imgurl' => $_POST['imgurl']
            );
            $lobjID = query($sqlString, $params, DBI::LAST_ID);
            $sqlString = "INSERT INTO learningobjectcategory VALUES(:lobjectid, :categoryid)";
            $params = array(
                'lobjectid' => $lobjID,
                'categoryid' => $_POST['categoryid']
            );
            query($sqlString, $params);

        }

        function getSchools () {
            $sqlString = "SELECT * FROM schools";
            $params = array();
            return query($sqlString, $params, DBI::FETCH_ALL);

        }

        function addSchool ($name, $fylke, $kommune) {
            $sqlString = "INSERT INTO schools (name, fylke, kommune) VALUES (:name, :fylke, :kommune)";
            $params = array(
                'name' => $name,
                'fylke' => $fylke,
                'kommune' => $kommune
            );
            query($sqlString, $params);

        }

        //Search-operations
        function searchSchools ($searchString) {
            $sqlString = "SELECT * FROM schools WHERE name LIKE :searchString";
            $params = array(
                'searchString' => '%'.$searchString.'%'
            );
            return query($sqlString, $params, DBI::FETCH_ALL);

        }

        function searchLearningObjects ($searchString) {
            $sqlString = "SELECT * FROM learningobjects WHERE title LIKE :searchString";
            $params = array(
                'searchString' => '%'.$searchString.'%'
            );
            return query($sqlString, $params, DBI::FETCH_ALL);

        }

        function searchCategories ($searchString) {
            $sqlString = "SELECT *, categories.imgurl as catimg FROM categories
                          JOIN subjectcategory on categories.id = categoryid
                          JOIN subjects on subjectid = subjects.id WHERE category LIKE :searchString";
            $params = array(
                'searchString' => '%'.$searchString.'%'
            );
            return query($sqlString, $params, DBI::FETCH_ALL);

        }

        function searchSubjects ($searchString) {
            $sqlString = "SELECT * FROM subjects WHERE subjectname LIKE :searchString";
            $params = array(
                'searchString' => '%'.$searchString.'%'
            );
            return query($sqlString, $params, DBI::FETCH_ALL);
        }

        //Update-operations
        function updateSchool ($name, $fylke, $kommune) {
            $sqlString = "UPDATE schools
                                        SET name = :name,
                                        fylke = :fylke,
                                        kommune = :kommune
                                        WHERE name = :name;";
            $params = array(
                'name' => $name,
                'fylke' => $fylke,
                'kommune' => $kommune
            );
            query($sqlString, $params);

        }

        function updateSubject ($subjectName, $classLevel, $imgUrl) {
            $sqlString = "UPDATE subjects
                                        SET subjectname = :subjectName,
                                         imgurl = :imgUrl
                                        WHERE subjectname = :subjectName;";
            $params = array(
                'subjectName' => $subjectName,
                'classLevel' => $classLevel,
                'imgUrl' => $imgUrl
            );
            query($sqlString, $params);

        }

        function updateCategory ($category, $imgUrl) {
            $sqlString = "UPDATE categories
                                        SET category = :category, imgurl = :imgUrl
                                        WHERE category = :category;";
            $params = array(
                'category' => $category,
                'imgUrl' => $imgUrl
            );
            query($sqlString, $params);

        }

        function updateLearningObject ($title, $link, $imgUrl) {
            $sqlString = "UPDATE learningobjects
                                                SET title = :title, link = :link, imgurl = :imgUrl
                                                WHERE title = :title;";
            $params = array(
                'title' => $title,
                'link' => $link,
                'imgUrl' => $imgUrl
            );
            query($sqlString, $params);

        }

        //Delete-operations
        function deleteSchool ($schoolId) {
            $sqlString = "DELETE FROM schools WHERE name = :schoolId";
            $params = array(
                'schoolId' => $schoolId
            );
            query($sqlString, $params);

//            global $database;
//
//            //Pupilhomework
//
//            //Homework
//
//            //ClassSubjectTeachers
//
//            //Main teachers
//
//            //CLassSubject
//
//            //Classes
//
//            //users
//
//            //school
//
        }

        function deleteSubject ($subjectID) {
            $sqlString1 = "DELETE FROM classsubjects WHERE subjectid = :subjectId";
            $sqlString2 = "DELETE FROM subjectcategory WHERE subjectid = :subjectId";
            $sqlString3 = "DELETE FROM subjects WHERE id = :subjectId";
            $params = array(
                'subjectId' => $subjectID
            );
            query($sqlString1, $params);
            query($sqlString2, $params);
            query($sqlString3, $params);
        }

        function deleteCategory ($categoryId) {
            $sqlString1 = "DELETE FROM learningobjectcategory WHERE categoryid = :categoryId";
            $sqlString2 = "DELETE FROM subjectcategory WHERE categoryid = :categoryId";
            $sqlString3 = "DELETE FROM categories WHERE id = :categoryId";
            $params = array(
                'categoryId' => $categoryId
            );
            query($sqlString1, $params);
            query($sqlString2, $params);
            query($sqlString3, $params);

        }

        function deleteLearningObject ($learningObjectId) {
            $sqlString1 = "DELETE FROM favourites WHERE learningobjectid = :learningObjectId";
            $sqlString2 = "DELETE FROM learningobjectcategory WHERE learningobjectid = :learningObjectId";
            $sqlString3 = "DELETE FROM learningobjects WHERE title = :learningObjectId";
            $params = array(
                'learningObjectId' => $learningObjectId
            );
            query($sqlString1, $params);
            query($sqlString2, $params);
            query($sqlString3, $params);
        }


