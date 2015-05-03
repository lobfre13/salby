<?php foreach($this->categoryContent as $content) { ?>
    <div onclick="<?php if(isset($content['category'])) echo 'loadCategoryContent('.$content['id'].')'; else echo 'addTask(this, '.$content['id'].')'; ?>"
         class="<?php if(isset($content['category'])) echo 'category'; else echo 'lobject'; ?>" style="background-image: url(<?php echo $content['imgurl']; ?>)">
        <h4 class="categoryname"><?php if(isset($content['category'])) echo $content['category']; else echo $content['title'];?></h4>
    </div>
<?php } ?>