<script>
    function addCategories () {
        ajaxCall("GET", "/admin/addCategories", true, "addCategories");
    }

    function doAddCategories () {
        var submit = document.getElementById("submitBtn");
        submit.click();
    }

    function deleteCategory (object, categoryId) {
        if (confirm('Er du sikker på at du vil fjerne denne kategorien?')) {
            ajaxCall("GET", "/admin/doDeleteCategory/" + categoryId, true);
            $(object).closest("tr").remove();
        }
    }
</script>
<div id="content" class="widthConstrained">
    <?php $this->showNotice();?>
    <section class="adminMenu">
        <a href="/admin/administrateSchools">Brukeradministrasjon</a>
        <a  href="/admin/administrateSubjects">Fag</a>
        <a style="background-color: #FF8700;" href="/admin/administrateCategories">Kategorier</a>
        <a href="/admin/administrateLearningobjects">Læringsobjekter</a>
    </section>
    <div class="tableBG">
        <section id="topMenu">

             <span class="submit" onclick="addCategories()">
                Legg til kategori
            </span>

                <form method="post" action="/admin/administrateCategories" class="form-wrapper">
                    <input type="text" id="search" name="searchBoxCategories" placeholder="Søk etter kategori...">
                    <input type="submit" value="søk" class="submit">
                </form>


        </section>

    <section id="maintable">
        <form id="addCategoriesForm" method="post" action="/admin/actuallyAddCategory" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Kategori</th>
                <th>Bilde</th>
                <th>Tilhørende fag</th>
                <th>Klassetrinn</th>
                <th></th>
            </tr>
            <tr id="addCategories"></tr>
            <?php foreach ($this->categories as $category) { ?>
                <tr>
                    <td><?php echo $category['category']?></td>
                    <td><img width="100" src="<?php echo $category['catimg']?>"></td>
                    <td><?php echo $category['subjectname']?></td>
                    <td><?php echo $category['classlevel']?></td>
                    <td class="editDeleteColumn"><a href="/admin/editCategories/<?php echo $category['catid']; ?>">
                            <div title="Rediger kategori" class="editBtn"></div>
                        </a><div title="Slett kategori" onclick="deleteCategory(this, <?php echo $category['catid'];?>)" class="deleteBtn">

                    </td>
                </tr>
            <?php } ?>
        </table>
            </form>
        </section>
    </div>
</div>