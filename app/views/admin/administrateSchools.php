<script>
    function addSchool () {
        ajaxCall("GET", "/admin/doAddSchool", true, "addSchool");
    }

    function doAddSchool () {
        var submit = document.getElementById("submitBtn");
        submit.click();
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
    <?php $this->showNotice();?>
    <section class="adminMenu">
        <a style="background-color: #FF8700;" href="/admin/administrateSchools">Brukeradministrasjon</a>
        <a href="/admin/administrateSubjects">Fag</a>
        <a href="/admin/administrateCategories">Kategorier</a>
        <a href="/admin/administrateLearningobjects">Læringsobjekter</a>
    </section>
    <div class="tableBG">
        <section id="topMenu">

            <span onclick="addSchool()">
                Legg til skole
            </span>

            <form method="post" action="/admin/administrateSchools" class="form-wrapper">
                <input type="text" id="search" name="searchBoxSchools" placeholder="Søk etter skole...">
                <input type="submit" value="søk" id="submit">
            </form>

        </section>
        <section id="maintable">
            <form id="addSchoolForm" method="post" action="/admin/actuallyAddSchool">
                <table>
                    <tr>
                        <th>Skolenavn</th>
                        <th>Fylke</th>
                        <th>Kommune</th>
                        <th></th>
                    </tr>
                    <tr id="addSchool"></tr>
                    <?php foreach ($this->schools as $school) { ?>
                        <tr>
                            <td><?php echo $school['name'] ?></td>
                            <td><?php echo $school['fylke'] ?></td>
                            <td><?php echo $school['kommune'] ?></td>
                            <td class="editDeleteColumn">
                                <a href="/admin/editSchools/<?php echo $school['id']; ?>" <div title="Rediger skole" class="editBtn"></div></a>
                                <div title="Slett skole" onclick="deleteSchool(this, <?php echo $school['id'];?>)" class="deleteBtn">
                            </td>
                        </tr>
                    <?php }  ?>
                </table>
            </form>
        </section>
    </div>
</div>