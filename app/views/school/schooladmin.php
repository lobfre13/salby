<script>
    function getClassesInLevel(classlevel){
        ajaxCall("GET", "/schooladmin/getClasses/"+classlevel.value, true, "chooseClassName");
    }
    function getClassPupils(classid){
        ajaxCall("GET", "/schooladmin/getClassPupils/"+classid.value, true, "classContent")
    }

    function showAddClass() {
        ajaxCall("GET", "/schooladmin/showAddClass", true, "addClass")
    }

    function doAddSchoolClass(){
        $('#addSchoolClassForm').submit();
    }
    function deleteSchoolClass(obj, classId){
        ajaxCall("GET", "/schooladmin/deleteSchoolClass/" + classId, true);
        $(obj).closest('tr').remove();
    }

</script>
<div id="content" class="widthConstrained">
    <?php include 'partialviews/topLinks.php'; ?>

    <h2>Skolens klasser</h2>

    <div id="classContent" class="tableBG">
        <section id="topMenu">
           <span onclick="showAddClass()">
                Legg til klasse <img src="/public/img/plussIkon.png" width="20">
            </span>

            <form method="post" action="/schooladmin" class="form-wrapper">
                <input type="text" id="search" name="searchBoxSchoolsClasses" placeholder="Søk etter klasse...">
                <input type="submit" value="søk" id="submit">
            </form>

        </section>
        <form method="post" action="/schooladmin/addNewSchoolClass" id="addSchoolClassForm">
            <table>
                <tr>
                    <th>Klassetrinn</th>
                    <th>Klasse</th>
                    <th>Endre</th>
                </tr>
                <tr id="addClass"></tr>
                <?php foreach ($this->classes as $class) { ?>
                    <tr>
                        <td><?php echo $class['classlevel'] ?></td>
                        <td><?php echo $class['classname'] ?></td>
                        <td><a href="/schooladmin/editSchoolClass/<?php echo $class['id']; ?>">
                                <div class="editBtn"></div>
                            </a>
                        <div onclick="deleteSchoolClass(this, <?php echo $class['id'];?>)" class="deleteBtn"></td>
                    </tr>
                <?php } ?>

            </table>
        </form>

    </div>

</div>