    <div id="content" class="widthConstrained">
        <div id="teacherClassList">
            <h3>Mine Klasser:</h3>
            <?php foreach($schoolClasses as $schoolClass) { ?>
                <a class="teachersClasses" href="/teacher/<?php echo $schoolClass['id']; ?>"> <?php echo $schoolClass['classlevel'].$schoolClass['classname']; ?></a></br>
            <?php } ?>
        </div>

        <?php if(isset($selectedSchoolClass)){ include 'teacherClass.php';} ?>
    </div>