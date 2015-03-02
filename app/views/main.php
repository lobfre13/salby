    <div id="content" class="widthConstrained">

        <div id="subjects">
            <?php foreach($subjects as $subject) { ?>
                <a href="#fag-<?php echo $subject['subjectid'];?>"><div class="subject"><img class="subjectimg" src="<?php echo $subject['imgurl']; ?>"><h4 class="subjectname"><?php echo $subject['subjectname']; ?></h4></div></a>
            <?php } ?>
        </div>

        <?php foreach($subjectCategories as $subjectCategory) { ?>
            <div id="fag-<?php echo $subjectCategory[0];?>" class="subjectContent">
                <?php foreach($subjectCategory[1] as $category) {?>
                    <a href="#kategori-<?php echo $category['id']; ?>">
                        <div class="category" style="background-image: url(<?php echo $category['imgurl']; ?>)">
                            <h4 class="categoryname"><?php echo $category['category']; ?></h4>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>

        <?php foreach($categoryContents as &$content){ ?>
            <div id="kategori-<?php echo $content[0]; ?>" class="subjectContent">
                <?php foreach($content[1] as $lobject){ ?>
                    <a href="/game/id/<?php echo $lobject['id']; ?>">
                        <div class="category" style="background-image: url(<?php echo $lobject['imgurl']; ?>)">
                            <h4 class="categoryname"><?php echo $lobject['title']; ?></h4>
                        </div>
                    </a>
                <?php } ?>
                <?php foreach($content[2] as $subCat){?>
                    <a href="#kategori-<?php echo $subCat['id']; ?>">
                        <div class="category" style="background-image: url(<?php echo $subCat['imgurl']; ?>)">
                            <h4 class="categoryname"><?php echo $subCat['category']; ?></h4>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>


    </div>