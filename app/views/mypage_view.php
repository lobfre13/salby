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

        <table style="width:100%">
            <tr>
                <td>Fag</td>
                <td>Oppgave</td>
                <td>Frist</td>
                <td>Utført</td>
            </tr>
                <?php
                foreach ($homeworkList as $homeworkItem) {
                    foreach ($homeworkSubjects as $homeworkSubject) {
                        echo '<tr>';
                        echo '<td>' . $homeworkSubject['subjectname'] . '</td>';
                        echo '<td><a href="/game/id/' . $homeworkItem['learningobjectid'] . '">' .
                            $homeworkItem['title'] . '</a></td>';
                        echo '<td>13-12-2014</td>';
                        echo '<td><input type="checkbox" name="myTextEditBox" value="checked" /></td>';
                        echo '</tr>';
                        }
                    }
                ?>
            </tr>
        </table>
    </div>

    <br>

    <h2>Favoritter</h2>

    <div id="favouriteList">

        <table style="width:100%">
            <tr>
                <?php
                foreach ($favouriteList as $favouriteItem) {
                    foreach ($homeworkSubjects as $homeworkSubject) {
                        foreach ($imgUrls as $imgUrl) {
                            echo '<td><img src="' . $imgUrl['imgurl'] . '"><a href="' . $favouriteItem['title'] . '"></a></td>';
                        }
                    }
                }
                ?>
            </tr>
        </table>
    </div>
</div>

