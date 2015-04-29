<script>
    function addLearningObject () {
        ajaxCall("GET", "/admin/addLearningObject", true, "addLearningObject");
    }

    function deleteLearningObject (object, learningObjectId) {
        ajaxCall("GET", "/admin/doDeleteLearningObject/" + learningObjectId, true);
        $(object).closest("tr").remove();
    }
</script>
<div id="content" class="widthConstrained">
    <?php include "PartialViews/adminMenu.php"?>
    <div id="schoolMainTable">
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
                    <td><div class="editBtn"></td>
                    <td><div onclick="deleteLearningObject(this, <?php echo $learningObject['id'];?>)" class="deleteBtn"></td>
                </tr>
            <?php } ?>
        </table>
            </section>
    </div>
</div>