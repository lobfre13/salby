<script>
    function showSubjects(btn){
        var obj = document.getElementById("subjects");
        if(obj.className === 'subjectsToggle subjects'){
            btn.innerText = "Vis Fag >>";
            obj.className = 'subjectsToggle';
        }
        else{
            btn.innerText = "Skjul fag <<";
            obj.className = 'subjectsToggle subjects';
        }
    }
</script>
<div id="content" class="widthConstrained">
    <div id="subjects" class="<?php echo $this->subjectsHTMLClass; ?>">
        <?php foreach($this->subjects as $subject) { ?>
            <a href="/forside/fag/<?php echo $this->classLevel; ?>-klasse/<?php echo slugify($subject['subjectname']); ?>"><div class="<?php echo $subject['htmlClasses'];?>"><img class="subjectimg" src="<?php echo $subject['imgurl']; ?>"><h4 class="subjectname"><?php echo $subject['subjectname']; ?></h4></div></a>
        <?php } ?>

    </div>
    <h4 id="subjectDropDownBtn" class="" onclick="showSubjects(this)">Vis Fag >></h4>

    <div class="subjectContent">
        <?php
        if(!arrayEmpty($this->categoryContent)){ ?>
            <ul class="breadcrumb">
                <li style="padding 0;"><a href="/"><img style="outline: 0;" src="/public/img/house.png" height="20"></a>
                </li>
           <?php foreach ($this->filePathURLS as $url){ ?>
                <li><a class="filePathLinks" href="<?php echo $url[0]; ?>"><?php echo $url[1]; ?></a></li>
        <?php }  ?>
            </ul>
                <?php echo '<br><br><br>';}?>
        <?php foreach($this->categoryContent as $content) { ?>
            <a href="<?php echo $this->urlStr; if(isset($content['category'])) echo slugify($content['category']); else echo slugify($content['title']); ?>">
                <div class="category" style="background-image: url(<?php echo $content['imgurl']; ?>)">
                    <h4 class="categoryname"><?php if(isset($content['category'])) echo $content['category']; else echo $content['title'];?></h4>
                </div>
            </a>
        <?php } ?>
    </div>

    <div id="game">
        <?php if(!($this->gameHTML == null)){ ?>
        <ul class="breadcrumb">
            <li><a href="/"><img src="/public/img/house.png" height="15"></a></li>
           <?php foreach ($this->filePathURLS as $url){ ?>
            <li><a class="filePathLinks" href="<?php echo $url[0]; ?>"><?php echo $url[1]; ?></a></li>
        <?php }  ?>
        </ul>
            <?php echo $this->gameHTML;
        }  ?>
    </div>

</div>