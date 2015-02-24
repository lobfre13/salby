    <div id="content" class="widthConstrained">
        <h2>Mine Klasser:</h2>
        <div id="teacherClassList">
            <?php foreach($schoolClasses as $schoolClass) { ?>
                <a class="teachersClasses" href="/teacher/<?php echo $schoolClass['id']; ?>"> <?php echo $schoolClass['classlevel'].$schoolClass['classname']; ?></a></br>
            <?php } ?>
        </div>
    </div>