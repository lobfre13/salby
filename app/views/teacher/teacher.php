    <div id="content" class="widthConstrained">
        <h2>Mine Klasser:</h2>

        <?php foreach($schoolClasses as $schoolClass) { ?>
            <a class="teachersClasses" href="/teacher/<?php echo $schoolClass['id']; ?>"> <?php echo $schoolClass['classname']; ?></a>
            </div>
        <?php } ?>
    </div>