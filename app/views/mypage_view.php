<div id="content" class="widthConstrained">
    <!-- printer brukernavn og passord, tatt bort 5/3-15
    <div class="mypage"  id="usernameAndClass">
        <ul>
            <?php
                echo '<li>' . $studentFullName['firstname'] . ' ' . $studentFullName['lastname'] . '</li>';
                echo '<li> Klasse ' . $schoolClass['classlevel'] . $schoolClass['classname'] . '</li>';
            ?>
        </ul>
    </div> -->
    <br>
    <h2>
        <?php
            echo 'Lekser uke ' . $weeknumber;
        ?>
    </h2>
    <div class="mypage" id="homeworkList">

        <table style="width:100%">
                <tr id="homeworkListHeader">
                    <th class ="subjectColumn">Fag</th>
                    <th class ="lObjectColumn">Oppgave</th>
                    <th class ="dateColumn">Frist</th>
                    <th class ="checkedColumn">Utført</th>
                </tr>
                <?php
                foreach ($homeworkSubjects as $homeworkSubject) {
                    echo '<tr>';
                    echo '<td class ="subjectColumn">' . $homeworkSubject['subjectname'] . '</td>';
                    echo '<td class ="lObjectColumn"><a href="/main/game/' . $homeworkSubject['learningobjectid'] . '">' .
                        $homeworkSubject['title'] . '</a></td>';
                    echo '<td class ="dateColumn">13. Mars</td>';
                    echo '<td class ="checkedColumn">
<form action="#">
  <p>
    <input type="checkbox" id="test1" />
    <label for="test1"></label>
  </p>
</form></td>';
                    echo '</tr>';
                    }
                ?>
            </tr>
        </table>
    </div>
    <br>
    <h2>Favoritter</h2>
    <div class="mypage" id="favouriteList">
        <?php
        foreach ($favouriteList as $favouriteItem) {
            echo '<div class="favouriteGames"><a href="/main/game/' . $favouriteItem['id'] . '"> <img id="favouritePicture" src="' . $favouriteItem['imgurl'] . '"></a>';
            echo '<form id="removeFavouriteButton" method="post"><input type="Submit" value=""><input type = "hidden" value="' . $favouriteItem['id'] .  '" name = "lObjectId"></form></div>';
        }
        ?>
    </div>
</div>

