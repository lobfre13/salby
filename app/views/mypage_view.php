<div id="content" class="widthConstrained">
    <div id="usernameAndClass">
        <ul>
            <?php
                echo '<li>' . $studentFullName['firstname'] . ' ' . $studentFullName['lastname'] . '</li>';
                echo '<li>' . $schoolClass['classlevel'] . $schoolClass['classname'] . '</li>';
            ?>
        </ul>
    </div>

    <br>

    <h2>
        <?php
            echo 'Lekser uke ' . $weeknumber;
        ?>
    </h2>

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

    <h2>Favoritter</h2>

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

