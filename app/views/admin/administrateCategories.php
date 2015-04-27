<div id="content" class="widthConstrained">
    <form method="post" action="/admin/doGetCategoriesSearchResult">
        <input type="text" name="searchBoxCategories">
        <input type="submit" value="Søk her...">
    </form>
    <table>
        <tr>
            <td>Kategori</td>
            <td>Bilde-URL</td>
            <td>Rediger</td>
            <td>Slett</td>
        </tr>
            <?php foreach ($this->categories as $category) { ?>
        <tr>
                <td><?php echo $category['category']?></td>
                <td><?php echo $category['imgrul']?></td>
                <td>RedigerSymbol</td>
                <td>SlettSymbol</td>
        </tr>
            <?php } ?>
    </table>
    <input type = "submit" value="Opprett kategori">
</div>