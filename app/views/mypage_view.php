<div id="content" class="widthConstrained">
    <p>
        <?php
        echo $username.' '.$schoolClass['classlevel'].$schoolClass['classname'];
        ?>
    </p>

    <ul>
        <?php
        foreach($homeworkList as $homeworkItem) {
            echo '<li><a href="/game/id/'.$homeworkItem['learningobjectid'].'">'.$homeworkItem['title'].'</a></li>';
        }
        ?>
    </ul>

    <ul>
        <?php
        foreach($favouriteList as $favouriteItem) {
            echo '<li><a href="/game/id/'.$favouriteItem['learningobjectid'].'">'.$favouriteItem['title'].'</a></li>';
        }
        ?>
    </ul>
</div>

