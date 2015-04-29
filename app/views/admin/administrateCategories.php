<script>
    function addCategories () {
        ajaxCall("GET", "/admin/addCategories", true, "addCategories");
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
                <td>Kategori</td>
                <td>Bilde</td>
                <td>Tilhørende fag</td>
                <td>Klassetrinn</td>
                <td></td>
                <td></td>
            </tr>
            <tr id="addCategories"></tr>
            <?php foreach ($this->categories as $category) { ?>
                <tr>
                    <td><?php echo $category['category']?></td>
                    <td><img src="<?php echo $category['catimg']?>"></td>
                    <td><?php echo $category['subjectname']?></td>
                    <td><?php echo $category['classlevel']?></td>
                    <td><img src="/public/img/redigerIkon.png" width="35"></td>
                    <td><img src="/public/img/slettIkon.png" width="35"></td>
                </tr>
            <?php } ?>
        </table>
        </section>
    </div>
</div>