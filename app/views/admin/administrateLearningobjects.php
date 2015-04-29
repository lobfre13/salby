<script>
    function addLearningObject () {
        ajaxCall("GET", "/admin/addLearningObject", true, "addLearningObject");
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
                    <td><img src="/public/img/redigerIkon.png" width="35"></td>
                    <td><img src="/public/img/slettIkon.png" width="35"></td>
                </tr>
            <?php } ?>
        </table>
            </section>
    </div>
</div>