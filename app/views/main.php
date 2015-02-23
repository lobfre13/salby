    <div id="content" class="widthConstrained">

        <div id="subjects">
            <?php foreach($subjects as $subject) { ?>
                <a href="#<?php echo $subject['subjectname'];?>"><div class="subject"><img src="<?php echo $subject['imgurl']; ?>"></div></a>
            <?php } ?>
        </div>

        <?php foreach($subjects as $subject) { ?>
            <div id="<?php echo $subject['subjectname'];?>" class="subjectContent">
                <?php foreach($lobjects as $lobject) { ?>
                    <div class="category"><h4><?php echo $lobject['category']; ?></h4></div>
                <?php } ?>
            </div>
        <?php } ?>

    </div>