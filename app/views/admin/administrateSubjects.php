<script>
    function addSubject () {
        ajaxCall("GET", "/admin/addSubject", true, "addSubject");
    }

    function doAddSubject () {
        var submit = document.getElementById("submitBtn");
        submit.click();
    }

    function deleteSubject (object, subjectId) {
        if (confirm('Er du sikker på at du vil fjerne dette faget?')) {
            ajaxCall("GET", "/admin/doDeleteSubject/" + subjectId, true);
            $(object).closest("tr").remove();
        }
    }
</script>
<div id="content" class="widthConstrained">
    <?php $this->showNotice();?>
    <section class="adminMenu">
        <a href="/admin/administrateSchools">Brukeradministrasjon</a>
        <a style="background-color: #FF8700;" href="/admin/administrateSubjects">Fag</a>
        <a href="/admin/administrateCategories">Kategorier</a>
        <a href="/admin/administrateLearningobjects">Læringsobjekter</a>
    </section>
    <div class="tableBG">
        <section id="topMenu">

           <span onclick="addSubject()">
                Legg til fag
            </span>

                <form method="post" action="/admin/administrateSubjects" class="form-wrapper">
                    <input type="text" id="search" name="searchBoxSubjects" placeholder="Søk etter fag...">
                    <input type="submit" value="søk" id="submit">
                </form>


        </section>

        <section id="maintable">
        <form id="addSubjectForm" method="post" action="/admin/actuallyAddSubject" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Fag</th>
                <th>Klassetrinn</th>
                <th>Ikon</th>
                <th></th>
            </tr>
            <tr id="addSubject"></tr>
                <?php foreach ($this->subjects as $subject) { ?>
                    <tr>
                        <td><?php echo $subject['subjectname']?></td>
                        <td><?php echo $subject['classlevel']?></td>
                        <td><img src="<?php echo$subject['imgurl']?>" width="35"></td>
                        <td class="editDeleteColumn">
                            <a href="/admin/editSubjects/<?php echo $subject['id']; ?>"><div title="Rediger fag" class="editBtn"></div></a>
                            <div title="Slett fag" onclick="deleteSubject(this, <?php echo $subject['id'];?>)" class="deleteBtn"></div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            </form>
        </section>
    </div>
</div>