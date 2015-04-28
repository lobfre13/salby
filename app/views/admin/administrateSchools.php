<script>
    function addSchool () {
        ajaxCall("GET", "/admin/doAddSchool", true, "addSchool");
    }

    function deleteSchool () {
        ajaxCall("GET", "/admin/doDeleteSchool", true, "deleteSchool");
    }
</script>
<div id="content" class="widthConstrained">
    <form method="post" action="/admin/administrateSchools">
        <input type="text" name="searchBoxSchools">
        <input type="submit" value="Søk her...">
    </form>
    <div id="schoolMainTable">
        <label><input type="button" onclick="addSchool()" value="" id="schoolAddButton">Legg til skole</label>
        <table>
            <tr>
                <th>Skolenavn</th>
                <th>Fylke</th>
                <th>Kommune</th>
                <th>Registreringsnøkkel</th>
                <th></th>
                <th></th>
            </tr>
            <tr id="addSchool"></tr>
            <?php foreach ($this->schools as $school) { ?>
                <tr>
                    <td><?php echo $school['name'] ?></td>
                    <td><?php echo $school['fylke'] ?></td>
                    <td><?php echo $school['kommune'] ?></td>
                    <td><?php echo $school['regkey'] ?></td>
                    <td><img src="/public/img/redigerIkon.png" width="35"></td>
                    <!-- HEEEEEEER!!! LINJEN UNDER HVORDAN FÅR MAN SENDT INN PARAMETER??-->
                    <td><img src="/public/img/slettIkon.png" width="35" onclick="deleteSchool(<?php echo $school['name']?>)"></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>