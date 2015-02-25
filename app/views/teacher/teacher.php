 <!-- Henter ut og velger klasse, har ikke fikset Oppgavedelen ennå siden vi venter på "å lage lekser" funksjonen -->

    <div id="content" class="widthConstrained">
        <div id="teacherClassList">
            <div id="teachergjoeremaal" class="teacherBoxes">Legg til gjøremål</div>
            <div id="teacherinstillinger" class="teacherBoxes">Instillinger for elever</div>
            <div id="teacherlaererside" class="teacherBoxes">Lærerside</div>

            <br>
            <br>
            <br>
            <div id="drownDownMenus">
                <div id="dropDownClass">
                <form method="post">
                <label></label>
                    <select name="categoryid">
                        <option value="blank">Velg klasse</option>
                        <?php foreach($schoolClasses as $schoolClass) { ?>
                         <option name="chosenClass"><?php echo $schoolClass['classlevel'].$schoolClass['classname']; ?></a></br></option>
            <?php } ?></select><br>
                </form>
                </div>
                <div id="dropDownHomework">
                    <form method="post">
                     <label></label>
                        <select name="categoryid">
                            <option value="blank">Velg Oppgave</option>
                            <?php foreach($schoolClasses as $schoolClass) { ?>
                                <option name="chosenClass"><?php echo $schoolClass['classlevel'].$schoolClass['classname']; ?></a></br></option>                        <?php } ?></select><br>
                 </form>
                </div>
            </div>
    </div>

        <?php if(isset($selectedSchoolClass)){ include 'teacherClass.php';} ?>
    </div>
