    <div id="content" class="widthConstrained">
        <h3>Fag: <?php echo $subject['subjectname']; ?></h3>
        <h4>Klassetrinn: <?php echo $subject['classlevel']; ?></h4>

        <h4>Kategorier:</h4>
        <ul>
            <?php foreach($categories as $category){ ?>
                <li><?php echo $category['category']; ?></li>
            <?php } ?>
        </ul>

        <form method="post">
            <label>Kategorinavn: </label> <input type="text" name="categoryname"><br>
            <label>Kategorilogo: </label> <input type="text" name="imgurl"><br>
            <input type="submit" value="Legg til!">
        </form>
    </div>