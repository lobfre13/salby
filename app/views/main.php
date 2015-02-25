    <div id="content" class="widthConstrained">

        <div id="subjects">
            <?php foreach($subjects as $subject) { ?>
                <a href="#<?php echo $subject['subjectname'];?>"><div class="subject"><img src="<?php echo $subject['imgurl']; ?>"></div></a>
            <?php } ?>
        </div>

        <?php foreach($subjects as $subject) { ?>
            <div id="<?php echo $subject['subjectname'];?>" class="subjectContent">
                <?php foreach($lobjects as $lobject) {
                if($lobject['subjectid'] === $subject['subjectid']) echo '<a href="/main/category/'.$lobject['categoryid'].'"><div class="category" style="background-image: url('.$lobject['imgurl'].');"><h4>'.$lobject['category'].'</h4></div></a>'; } ?>
            </div>
        <?php } ?>

    </div>