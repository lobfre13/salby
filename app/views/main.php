    <div id="content" class="widthConstrained">

        <div id="subjects">
            <?php foreach($subjects as $subject) { ?>
                <a href="#fag-<?php echo $subject['subjectid'];?>"><div class="subject"><img src="<?php echo $subject['imgurl']; ?>"><h4 class="subjectname"><?php echo $subject['subjectname']; ?></h4></div></a>
            <?php } ?>
        </div>

        <?php foreach($subjects as $subject) { ?>
            <div id="fag-<?php echo $subject['subjectid'];?>" class="subjectContent">
                <?php foreach($categories as $category) {
                    if($category['subjectid'] == $subject['subjectid']) echo '<a href="#kategori-'.$category['id'].'"><div class="category" style="background-image: url('.$category['imgurl'].');"><h4 class="categoryname">'.$category['category'].'</h4></div></a>';
                } ?>
            </div>

        <?php } ?>

        <?php foreach($categories as $category){ ?>
            <div id="kategori-<?php echo $category['id']; ?>" class="subjectContent">
                <?php foreach($lobjects as $lobject){ ?>
                    <?php if($lobject['categoryid'] == $category['id']) echo '<a href="/game/id/'.$lobject['id'].'"><div class="category" style="background-image: url('.$lobject['imgurl'].');">'.$lobject['title'].'</div></a>';?>
                <?php } ?>
            </div>
        <?php } ?>


    </div>