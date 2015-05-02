<script>
    function addSchool () {
        ajaxCall("GET", "/admin/doAddSchool", true, "addSchool");
    }

    function doAddSchool () {
        $('#addSchoolForm').submit();
    }

    function deleteSchool (object, schoolId) {
        if (confirm('Er du sikker på at du vil fjerne denne skolen?')) {
            if(confirm("Er du helt sikker? \n Alt tilhørende skolen vil bli slettet! inkludert brukere og klasser..")){
                ajaxCall("GET", "/admin/doDeleteSchool/" + schoolId, true);
                $(object).closest("tr").remove();
            }
        }
    }

    function editSchool (object) {
        $(object).closest("tr").remove();
    }
</script>
<div id="content" class="widthConstrained">
    <?php include "PartialViews/adminMenu.php"?>
    <div class="tableBG">
        <section id="topMenu">

            <div id="schoolAddButtonDiv" onclick="addSchool()">
                <button type="button" id="schoolAddButton"></button>
                <label id="addSchoolTxt">Legg til skole</label>
            </div>

            <div id="schoolSearch">
                <form method="post" action="/admin/administrateSchools" class="form-wrapper">
                    <input type="text" id="search" name="searchBoxSchools" placeholder="Søk etter skole...">
                    <input type="submit" value="søk" id="submit">
                </form>
            </div>

        </section>
        <section id="maintable">
            <form id="addSchoolForm" method="post" action="/admin/actuallyAddSchool">
                <table>
                    <tr>
                        <th>Skolenavn</th>
                        <th>Fylke</th>
                        <th>Kommune</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr id="addSchool"></tr>
                    <?php foreach ($this->schools as $school) { ?>
                        <tr>
                            <td><?php echo $school['name'] ?></td>
                            <td><?php echo $school['fylke'] ?></td>
                            <td><?php echo $school['kommune'] ?></td>
                            <td><a href="/admin/editSchools/<?php echo $school['id']; ?>" <div class="editBtn"></div></td>
                            <td><div onclick="deleteSchool(this, <?php echo $school['id'];?>)" class="deleteBtn"></td>
                        </tr>
                    <?php }  ?>
                </table>
            </form>
        </section>
    </div>
</div>