
<div id="content" class="widthConstrained">
    <?php include $this->root."/app/views/admin/PartialViews/adminMenu.php"?>
    <div class="tableBG">
        <h2><?php echo $this->subject['subjectname']." ".$this->subject['classlevel'].'. klasse'; ?></h2>

        <form method="post" action="/admin/updateSubject" enctype="multipart/form-data">
            <input name="id" type="hidden" value="<?php echo $this->subject['id']; ?>">
            <input name="title" type="text" placeholder="Tittel" value="<?php echo $this->subject['subjectname']; ?>">
            <td><input type="file" name="pic" id="pic"></td>
            <input name="classlevel" type="text" placeholder="Klassetrinn" value="<?php echo $this->subject['classlevel']; ?>">
            <input type="submit" value="Oppdater">
        </form>

    </div>
</div>
