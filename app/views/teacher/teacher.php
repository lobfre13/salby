    <div id="content" class="widthConstrained">
        <div id="teacherClassList">
            <div id="teachergjoeremaal" class="teacherBoxes">Legg til gjøremål</div>
            <div id="teacherinstillinger" class="teacherBoxes">Instillinger for elever</div>
            <div id="teacherlaererside" class="teacherBoxes">Lærerside</div>
        </div>

        <form method="post">
            <label>Kategori: </label><select name="categoryid">
                <?php foreach($categories as $category){ ?>
                    <option value="<?php echo $category['categoryid']; ?>"><?php echo $category['category'] . '<br> Fag: ' . $category['subjectname']; ?></option>
                <?php } ?>
            </select><br>
        </form>



        <?php if(isset($selectedSchoolClass)){ include 'teacherClass.php';} ?>
    </div>
