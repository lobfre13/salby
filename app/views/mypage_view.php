<div id="content" class="widthConstrained">
    <div class="mypage"  id="usernameAndClass">
        <ul>
            <?php
                echo '<li>' . $studentFullName['firstname'] . ' ' . $studentFullName['lastname'] . '</li>';
                echo '<li> Klasse ' . $schoolClass['classlevel'] . $schoolClass['classname'] . '</li>';
            ?>
        </ul>
    </div>

    <br>

    <h2>
        <?php
            echo 'Lekser uke ' . $weeknumber;
        ?>
    </h2>

    <div class="mypage" id="homeworkList">

        <table style="width:100%">
                <tr id="homeworkListHeader">
                    <td>Fag</td>
                    <td>Oppgave</td>
                    <td>Frist</td>
                    <td>Utført</td>
                </tr>
                <?php
                foreach ($homeworkSubjects as $homeworkSubject) {
                    echo '<tr>';
                    echo '<td>' . $homeworkSubject['subjectname'] . '</td>';
                    echo '<td><a href="/game/id/' . $homeworkSubject['learningobjectid'] . '">' .
                        $homeworkSubject['title'] . '</a></td>';
                    echo '<td>13-12-2014</td>';
                    echo '<td><input type="checkbox" name="myTextEditBox" value="checked" /></td>';
                    echo '</tr>';
                    }
                ?>
            </tr>
        </table>
    </div>

    <br>

    <h2>Favoritter</h2>

    <div class="mypage"  id="favouriteList">

                <?php
                foreach ($favouriteList as $favouriteItem) {
                    echo ' <img id="favouritePicture" src="' . $favouriteItem['imgurl'] . '"><a href="' . $favouriteItem['title'] . '"></a>';
                }
                ?>
    </div>
</div>

