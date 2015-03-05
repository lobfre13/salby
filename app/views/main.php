    <script>
        function nav(obj, id){
            var url = document.URL;
            var opacityValue = '0.3';
            if(url.indexOf("#fag-"+ id) > -1){
                opacityValue = '1';
                window.location.href = "#";
            }
            else{
                window.location.href = '#fag-'+id;
            }

            var subjects =  document.getElementsByClassName("subjectimg");
            for(var i = 0; i < subjects.length; i++){
                subjects[i].style.opacity = opacityValue;
                subjects[i].nextSibling.style.backgroundColor = "#5C9632";
                subjects[i].parentNode.className = subjects[i].parentNode.className + " subjectNormal";
            }
            obj.firstChild.style.opacity = "1";
            obj.children[1].style.backgroundColor = "#00BFD5";
        }
    </script>
    <div id="content" class="widthConstrained">

        <div id="subjects">
            <?php foreach($subjects as $subject) { ?>
                <div onclick="nav(this,<?php echo $subject['subjectid'];?>)" class="subject"><img class="subjectimg" src="<?php echo $subject['imgurl']; ?>"><h4 class="subjectname"><?php echo $subject['subjectname']; ?></h4></div>
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

        <?php foreach($categoryContents as $content){ ?>
            <div id="kategori-<?php echo $content[0]; ?>" class="subjectContent">
                <?php foreach($content[1] as $lobject){ ?>
<!--                    <a href="/game/id/--><?php //echo $lobject['id']; ?><!--">-->
                        <div onclick="loadGame(<?php echo $lobject['id']; ?>)" class="category" style="background-image: url(<?php echo $lobject['imgurl']; ?>)">
                            <h4 class="categoryname"><?php echo $lobject['title']; ?></h4>
                        </div>
<!--                    </a>-->
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


        <div id="game"><?php echo $gameHTML; ?></div>

    </div>