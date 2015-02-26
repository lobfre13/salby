<div id="content" class="widthConstrained">
    <p>
        <?php
        echo $schoolClass['classlevel'];
        echo $schoolClass['classname'];
        ?>
    </p>

    <ul>
        <?php
        foreach($homeworkList as $homeworkItem) {
            echo "<li>".$homeworkItem['title']."</li>";
        }
        ?>
    </ul>

    <ul>
        <?php
        foreach($favouriteList as $favouriteItem) {
            echo "<li>".$favouriteItem['title']."</li>";
        }
        ?>
    </ul>
</div>

