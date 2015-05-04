<script>
    function addCategories () {
        ajaxCall("GET", "/admin/addCategories", true, "addCategories");
    }

    function doAddCategories () {
        $('#addCategoriesForm').submit();
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
    <div class="tableBG">
        <section id="topMenu">

             <span onclick="addCategories()">
                Legg til kategori
            </span>

                <form method="post" action="/admin/administrateCategories" class="form-wrapper">
                    <input type="text" id="search" name="searchBoxCategories" placeholder="Søk etter kategori...">
                    <input type="submit" value="søk" id="submit">
                </form>


        </section>

    <section id="maintable">
        <form id="addCategoriesForm" method="post" action="/admin/actuallyAddCategory" enctype="multipart/form-data">
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
                    <td><a href="/admin/editCategories/<?php echo $category['catid']; ?>">
                            <div class="editBtn"></div>
                        </a></td>
                    <td><div onclick="deleteCategory(this, <?php echo $category['catid'];?>)" class="deleteBtn"></td>
                </tr>
            <?php } ?>
        </table>
            </form>
        </section>
    </div>
</div>