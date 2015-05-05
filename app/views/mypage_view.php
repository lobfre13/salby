<script>
    function updateHomeworkStatus(homeworkid){
        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","/mypage/updateHomework/" + homeworkid, true);
        xmlhttp.send();
    }


</script>


<div id="content" class="widthConstrained">
<!--    // printer brukernavn og passord, tatt bort 5/3-15-->
<!--    <div class="mypage"  id="usernameAndClass">-->
<!--        <ul>-->
<!--            --><?php
//    echo '<li>' . $this->studentFullName['firstname'] . ' ' . $this->studentFullName['lastname'] . '</li>';
//    echo '<li> Klasse ' . $this->schoolClass['classlevel'] . $this->schoolClass['classname'] . '</li>';
//    ?>
<!--        </ul>-->
<!--    </div>-->
<!--    <br>-->
    <h2>
        <?php
        echo 'Lekser';
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
            <?php $i = 0;
                foreach ($this->homeworkSubjects as $homeworkSubject){
                    $i++; ?>
                    <tr>
                        <td class ="subjectColumn"><?php echo $homeworkSubject['subjectname']; ?></td>
                        <td class ="lObjectColumn">
                            <a href="<?php echo $homeworkSubject['url']; ?>"><?php echo $homeworkSubject['title']; ?></a>
                        </td>
                        <td class ="dateColumn"><?php echo date('Y-m-d', strtotime($homeworkSubject['duedate'])); ?></td>
                        <td class ="checkedColumn">
                            <form>
                                <p>
                                    <input <?php if($homeworkSubject['isdone'] == 1) echo 'checked';?> onchange="updateHomeworkStatus(<?php echo $homeworkSubject['id']; ?>)" type="checkbox" id="test<?php echo $i; ?>" />
                                    <label for="test<?php echo $i; ?>"></label>
                                </p>
                            </form>
                        </td>
                    </tr>
            <?php } ?>
        </table>
    </div>
    <br>
    <h2>Favoritter</h2>
    <div class="mypage" id="favouriteList">
        <?php
            foreach ($this->favouriteList as $favouriteItem) { ?>
                <div class="favouriteGames">
                    <a title="<?php echo $favouriteItem['title']; ?>" href="<?php echo $favouriteItem['url']; ?>"> <img
                            id="favouritePicture" src="<?php echo $favouriteItem['imgurl']; ?>"></a>
                    <form action="/mypage/removeFavourite" onsubmit="return confirm('Er du sikker på at du vil fjerne denne favoritten?')" id="removeFavouriteButton" method="post">
                        <input type="Submit" value=""><input type = "hidden" value="<?php echo $favouriteItem['id']; ?>" name="lObjectId">
                    </form>
                </div>
        <?php } ?>
    </div>
</div>
