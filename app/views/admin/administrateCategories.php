<script>
    function addCategories () {
        ajaxCall("GET", "/admin/addCategories", true, "addCategories");
    }

    function deleteCategory (object, categoryId) {
        if (confirm('Er du sikker på at du vil fjerne denne kategorien?')) {
            ajaxCall("GET", "/admin/doDeleteCategory/" + categoryId, true);
            $(object).closest("tr").remove();
        }
    }
</script>
<div id="content" class="widthConstrained">
    <?php include "PartialViews/adminMenu.php"?>
    <div id="schoolMainTable">
        <section id="topMenu">

            <div id="schoolAddButtonDiv" onclick="addCategories()">
                <button type="button" id="schoolAddButton"></button>
                <label id="addSchoolTxt">Legg til kategori</label>
            </div>

            <div id="schoolSearch">
                <form method="post" action="/admin/administrateCategories" class="form-wrapper">
                    <input type="text" id="search" name="searchBoxCategories" placeholder="Søk etter kategori...">
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
                    <td><div class="editBtn"></td>
                    <td><div onclick="deleteCategory(this, <?php echo $category['catid'];?>)" class="deleteBtn"></td>
                </tr>
            <?php } ?>
        </table>
        </section>
    </div>
</div>