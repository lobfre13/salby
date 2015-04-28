<script>
    function addCategories () {
        ajaxCall("GET", "/admin/addCategories", true, "addCategories");
    }
</script>
<div id="content" class="widthConstrained">
    <form method="post" action="/admin/doGetCategoriesSearchResult">
        <input type="text" name="searchBoxCategories">
        <input type="submit" value="Søk her...">
    </form>
    <div id="categoriesMainTable">
        <label><input type="button" onclick="addCategories()" value="" id="categoryAddButton">Legg til kategori</label>
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
    </div>
</div>