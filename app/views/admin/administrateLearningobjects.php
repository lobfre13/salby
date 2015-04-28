<script>
    function addLearningObject () {
        ajaxCall("GET", "/admin/addLearningObject", true, "addLearningObject");
    }
</script>
<div id="content" class="widthConstrained">
    <form method="post" action="/admin/administrateLearningObjects">
        <input type="text" name="searchBoxLearningObjects">
        <input type="submit" value="Søk her...">
    </form>
    <div id="learningObjectMainTable">
        <label><input type="button" onclick="addLearningObject()" value="" id="learningObjectAddButton">Legg til læringsobjekt</label>
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
    </div>
</div>