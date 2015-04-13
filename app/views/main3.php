
<div id="content" class="widthConstrained">
    <div id="subjects">
        <?php foreach($this->subjects as $subject) { ?>
            <a href="/main/subject/<?php echo $this->classLevel; ?>/<?php echo $subject['subjectname']; ?>"><div class="subject subjectNormal"><img class="subjectimg" src="<?php echo $subject['imgurl']; ?>"><h4 class="subjectname"><?php echo $subject['subjectname']; ?></h4></div></a>
        <?php } ?>
    </div>

    <div class="subjectContent">
        <?php foreach($this->categoryContent as $content) { ?>
            <a href="<?php echo $this->url; if(isset($content['category'])) echo slugify($content['category']); else echo slugify($content['title']); ?>">
                <div class="category" style="background-image: url(<?php echo $content['imgurl']; ?>)">
                    <h4 class="categoryname"><?php if(isset($content['category'])) echo $content['category']; else echo $content['title'];?></h4>
                </div>
            </a>
        <?php } ?>
    </div>

    <div id="game"><?php echo $this->gameHTML; ?></div>

</div>
<script src="/public/javascript/subjectNavBar.js"></script>