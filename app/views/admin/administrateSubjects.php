<script>
    function addSubject () {
        ajaxCall("GET", "/admin/addSubject", true, "addSubject");
    }
</script>
<div id="content" class="widthConstrained">
    <form method="post" action="/admin/administrateSubjects">
        <input type="text" name="searchBoxSubjects">
        <input type="submit" value="Søk her...">
    </form>
    <div id="subjectMainTable">
        <label><input type="button" onclick="addSubject()" value="" id="subjectAddButton">Legg til fag</label>
        <table>
            <tr>
                <td>Fag</td>
                <td>Klassetrinn</td>
                <td>Fag-ikon</td>
                <td></td>
                <td></td>
            </tr>
            <tr id="addSubject"></tr>
            <?php foreach ($this->subjects as $subject) { ?>
                <tr>
                    <td><?php echo $subject['subjectname']?></td>
                    <td><?php echo $subject['classlevel']?></td>
                    <td><img src="<?php echo$subject['imgurl']?>" width="35"></td>
                    <td><img src="/public/img/redigerIkon.png" width="35"></td>
                    <td><img src="/public/img/slettIkon.png" width="35"></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>