<div id="content" class="widthConstrained">
    <?php include 'partialviews/topLinks.php'; ?>


    <div>
        <h2>Opprett ny klasse</h2>
        <form method="post" action="/schooladmin/addNewSchoolClass">
            <label for="chooseClassLevel">Velg trinn</label>
            <select id="chooseClassLevel" required name="classLevel">
                <option value="" disabled selected>Velg trinn..</option>
                <?php for($i = 1; $i < 8; $i++) {?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?>. klasse</option>
                <?php }?>
            </select><br>
            <label for="chooseClassName">Velg klasse</label>
            <input id="chooseClassName" type="text" name="className" placeholder="A-Z" maxlength="1" required><br>
            <input type="submit" value="Opprett klasse">
        </form>
    </div>
</div>