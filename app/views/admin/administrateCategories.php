<div id="content" class="widthConstrained">
    <table>
        <tr>
            <td>Kategori</td>
            <td>Bilde-URL</td>
            <td>Rediger</td>
            <td>Slett</td>
        </tr>
        <tr>
            <?php foreach ($categories as $category) { ?>
                <td><?php echo $category['category']?></td>
                <td><?php echo $category['imgrul']?></td>
                <td>RedigerSymbol</td>
                <td>SlettSymbol</td>
            <?php } ?>
        </tr>
    </table>
</div>