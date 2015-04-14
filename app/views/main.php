
<div id="content" class="widthConstrained">
    <div id="subjects">
        <?php foreach($this->subjects as $subject) { ?>
            <a href="/main/subject/<?php echo $this->classLevel; ?>/<?php echo $subject['subjectname']; ?>"><div class="subject subjectNormal <?php if($this->selectedSubject === $subject['subjectname']) echo 'selectedSubject';?>"><img class="subjectimg" src="<?php echo $subject['imgurl']; ?>"><h4 class="subjectname"><?php echo $subject['subjectname']; ?></h4></div></a>
        <?php } ?>
    </div>

    <div class="subjectContent">
        <?php $c = array_filter($this->categoryContent);
        if(!empty($c)){
            foreach ($this->filePathURLS as $url){ ?>
                <a class="filePathLinks" href="<?php echo $url[0]; ?>"><?php echo $url[1]; ?></a>
        <?php } echo '<br><br><br>';}?>
        <?php foreach($this->categoryContent as $content) { ?>
            <a href="<?php echo $this->urlStr; if(isset($content['category'])) echo slugify($content['category']); else echo slugify($content['title']); ?>">
                <div class="category" style="background-image: url(<?php echo $content['imgurl']; ?>)">
                    <h4 class="categoryname"><?php if(isset($content['category'])) echo $content['category']; else echo $content['title'];?></h4>
                </div>
            </a>
        <?php } ?>
    </div>

    <div id="game">
        <?php if(!($this->gameHTML == null)){
            foreach ($this->filePathURLS as $url){
                echo '<a class="filePathLinks" href="'.$url[0].'">'.$url[1].'</a>';
            }
            echo $this->gameHTML;
        }  ?>
    </div>

</div>
<script src="/public/javascript/subjectNavBar.js"></script>