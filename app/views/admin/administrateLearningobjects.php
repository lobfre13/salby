<script xmlns="http://www.w3.org/1999/html">
    function addLearningObject () {
        ajaxCall("GET", "/admin/addLearningObject", true, "addLearningObject");
    }

    function doAddLearningObject () {
        $('#addLearningObjectsForm').submit();
    }

    function deleteLearningObject (object, learningObjectId) {
        if (confirm('Er du sikker på at du vil fjerne dette læringsobjektet?')) {
            ajaxCall("GET", "/admin/doDeleteLearningObject/" + learningObjectId, true);
            $(object).closest("tr").remove();
        }
    }
</script>
<div id="content" class="widthConstrained">
    <?php include "PartialViews/adminMenu.php"?>
    <div class="tableBG">
        <section id="topMenu">

            <div id="schoolAddButtonDiv" onclick="addLearningObject()">
                <button type="button" id="schoolAddButton"></button>
                <label id="addSchoolTxt">Legg til læringsobjekt</label>
            </div>

            <div id="schoolSearch">
                <form method="post" action="/admin/administrateLearningobjects" class="form-wrapper">
                    <input type="text" id="search" name="searchBoxLearningObjects" placeholder="Søk etter læringsobjekt...">
                    <input type="submit" value="søk" id="submit">
                </form>
            </div>
        </section>

        <section id="maintable">
            <form id="addLearningObjectsForm" method="post" action="/admin/actuallyAddLearningObject">
        <table>
            <tr>
                <td>Tittel</td>
                <td>Ikon</td>
                <td>Læringsobjekt</td>
                <td></td>
                <td></td>
            </tr>
            <tr id="addLearningObject"></tr>
            <?php foreach ($this->learningObjects as $learningObject) { ?>
                <tr>
                    <td><?php echo $learningObject['title']?></td>
                    <td><img src="<?php echo $learningObject['imgurl']?>" width="35"></td>
                    <td><a href="<?php echo $learningObject['link']?>">Gå til læringsobjektet</a></td>
                    <td><a href="/admin/editLearningobjects/<?php echo $learningObject['id']; ?>"><div class="editBtn"></div></a></td>
                    <td><div onclick="deleteLearningObject(this, <?php echo $learningObject['id'];?>)" class="deleteBtn"></td>
                </tr>
            <?php } ?>
        </table>
            </form>
            </section>
    </div>
</div>