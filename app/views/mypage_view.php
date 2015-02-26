<div id="content" class="widthConstrained">
    <div id="usernameAndClass">
        <p>
            <?php
                echo $username . ' ' . $schoolClass['classlevel'] . $schoolClass['classname'];
            ?>
        </p>
    </div>

    <br>

    <div id="homeworkList">
        <ul>
            <?php
            foreach ($homeworkList as $homeworkItem) {
                echo '<li><a href="/game/id/' . $homeworkItem['learningobjectid'] . '">' . $homeworkItem['title'] . '</a></li>';
            }
            ?>
        </ul>
    </div>

    <br>

    <div id="favouriteList">
        <ul>
            <?php
            foreach ($favouriteList as $favouriteItem) {
                echo '<li><a href="/game/id/' . $favouriteItem['learningobjectid'] . '">' . $favouriteItem['title'] . '</a></li>';
            }
            ?>
        </ul>
    </div>
</div>

