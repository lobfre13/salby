<script>
    function addSubject () {
        ajaxCall("GET", "/admin/addSubject", true, "addSubject");
    }

    function doAddSubject () {
        $('#addSubjectForm').submit();
    }

    function deleteSubject (object, subjectId) {
        if (confirm('Er du sikker på at du vil fjerne dette faget?')) {
            ajaxCall("GET", "/admin/doDeleteSubject/" + subjectId, true);
            $(object).closest("tr").remove();
        }
    }
</script>
<div id="content" class="widthConstrained">
    <?php include "PartialViews/adminMenu.php"?>
    <div class="tableBG">
        <section id="topMenu">

            <div id="schoolAddButtonDiv" onclick="addSubject()">
                <button type="button" id="schoolAddButton"></button>
                <label id="addSchoolTxt">Legg til fag</label>
            </div>

            <div id="schoolSearch">
                <form method="post" action="/admin/administrateSubjects" class="form-wrapper">
                    <input type="text" id="search" name="searchBoxSubjects" placeholder="Søk etter fag...">
                    <input type="submit" value="søk" id="submit">
                </form>
            </div>

        </section>

        <section id="maintable">
        <form id="addSubjectForm" method="post" action="/admin/actuallyAddSubject" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Fag</td>
                <td>Klassetrinn</td>
                <td>Fag-ikon</td>
                <td></td>
                <td></td>
            </tr>
            <tr id="addSubject"></tr>
                <?php foreach ($this->subjects as $subject) { ?>
                    <tr>
                        <td><?php echo $subject['subjectname']?></td>
                        <td><?php echo $subject['classlevel']?></td>
                        <td><img src="<?php echo$subject['imgurl']?>" width="35"></td>
                        <td><a href="/admin/editSubjects/<?php echo $subject['id']; ?>"><div class="editBtn"></div></a></td>
                        <td><div onclick="deleteSubject(this, <?php echo $subject['id'];?>)" class="deleteBtn"></div></td>
                    </tr>
                <?php } ?>
            </table>
            </form>
        </section>
    </div>
</div>