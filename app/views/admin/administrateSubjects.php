<script>
    function addSubject () {
        ajaxCall("GET", "/admin/addSubject", true, "addSubject");
    }
</script>
<div id="content" class="widthConstrained">
    <div id="schoolMainTable">
        <section id="topMenu">

            <div id="schoolAddButtonDiv" onclick="addSchool()">
                <button type="button" id="schoolAddButton"></button>
                <label id="addSchoolTxt">Legg til skole</label>
            </div>

            <div id="schoolSearch">
                <form method="post" action="/admin/administrateSchools" class="form-wrapper">
                    <input type="text" id="search" name="searchBoxSchools" placeholder="Søk etter skole...">
                    <input type="submit" value="søk" id="submit">
                </form>
            </div>

        </section>

        <section id="maintable">
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
        </section>
    </div>
</div>