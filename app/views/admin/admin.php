    <div id="content" class="widthConstrained">

        <h3>Fag i databasen:</h3>
        <ul>
            <?php foreach($subjects as $subject){ ?>
                <li><a href="/admin/fag/<?php echo $subject['id']; ?>"> <?php echo $subject['subjectname'] . ' trinn: ' . $subject['classlevel']; ?></a></li>
            <?php } ?>
        </ul>

        <h4>Legg til fag:</h4>
        <form method="post">
           <label>Fagnavn: </label> <input type="text" name="subjectname"><br>
           <label>Klassetrinn: </label> <input type="text" name="classlevel"> <br>
            <label>Faglogo: </label> <input type="text" name="imgurl"> <br>
            <input type="submit" value="Legg til!">
        </form>


        <h4>Legg til læringsobjekter:</h4>
        <form method="post">
            <label>Tittel: </label><input type="text" name="lobjecttitle"><br>
           <label>URL: </label> <input type="text" name="url"><br>
            <label>Logo: </label> <input type="text" name="imgurl"><br>
            <label>Kategori: </label><select name="categoryid">
                <?php foreach($categories as $category){ ?>
                <option value="<?php echo $category['categoryid']; ?>"><?php echo $category['category'] . '<br> Fag: ' . $category['subjectname']; ?></option>
                <?php } ?>
            </select><br>
            <input type="submit" value="Legg til!">
        </form>

    </div>