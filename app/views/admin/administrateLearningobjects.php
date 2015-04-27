<div id="content" class="widthConstrained">
    <form method="post" action="/admin/doGetLearningobjectsSearchResult">
        <input type="text" name="searchBoxLearningObjects">
        <input type="submit" value="Søk her...">
    </form>
    <table>
        <tr>
            <td>Tittel</td>
            <td>Bilde-URL</td>
            <td>Rediger</td>
            <td>Slett</td>
        </tr>
            <?php foreach ($this->learningObjects as $learningObject) { ?>
        <tr>
                <td><?php echo $learningObject['title']?></td>
                <td><?php echo $learningObject['imgurl']?></td>
                <td>RedigerSymbol</td>
                <td>SlettSymbol</td>
        </tr>
            <?php } ?>
    </table>
</div>