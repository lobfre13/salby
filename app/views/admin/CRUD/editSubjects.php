
<div id="content" class="widthConstrained">
    <?php $this->showNotice();?>
    <section class="adminMenu">
        <a href="/admin/administrateSchools">Brukeradministrasjon</a>
        <a style="background-color: #FF8700;" href="/admin/administrateSubjects">Fag</a>
        <a href="/admin/administrateCategories">Kategorier</a>
        <a href="/admin/administrateLearningobjects">Læringsobjekter</a>
    </section>
    <div class="tableBG">
        <h2><?php echo $this->subject['subjectname']." ".$this->subject['classlevel'].'. klasse'; ?></h2>

        <div class="relationTable centerDiv">

            <form method="post" action="/admin/updateSubject" enctype="multipart/form-data">
                <input name="id" type="hidden" value="<?php echo $this->subject['id']; ?>" required>
                <label>Fagnavn <br>
                <input name="title" type="text" placeholder="Tittel" value="<?php echo $this->subject['subjectname']; ?>" required></label><br><br>
                <td><label for="pic">Faglogo</label><br><input type="file" name="pic" id="pic"></td><br><br>
                <label>Klassetrinn <br>
                <input name="classlevel" type="text" placeholder="Klassetrinn" value="<?php echo $this->subject['classlevel']; ?>" required></label><br>
                <input class="submit" type="submit" value="Oppdater">
            </form>
        </div>

    </div>
</div>
