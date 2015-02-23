    <div id="content" class="widthConstrained">
       <h2>Administrasjon av klasse: <?php echo $schoolClass['classname'];?></h2>
        <h4>Elever i denne klassen:</h4>
        <ul>
            <?php foreach($pupils as $pupil) {?>
                <li><?php echo $pupil['username']; ?></li>
            <?php } ?>
        </ul>

        <h5>Legg til elever i klassen:</h5>
        <form method="post">
            <textarea name="users" cols="25" rows="5"></textarea><br>
            <input name="classname" type="hidden" value="<?php echo $schoolClass['classname'];?>">
            <input type="submit" value="Opprett brukere">
        </form>

        <h4>Fag:</h4>
        <ul>
            <?php foreach($subjects as $subject) {?>
                <li><?php echo $subject['subjectname']; ?></li>
            <?php } ?>
        </ul>

        <h5>Legg til fag:</h5>
        <form method="post">
           <select name="subjectid">
               <?php foreach($allSubjects as $subject){ ?>
                <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subjectname']; ?></option>
               <?php } ?>
           </select>
            <input type="submit" value="Legg til!">
        </form>
    </div>