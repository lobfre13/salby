<script>
    function addSchool () {
        ajaxCall("GET", "/admin/doAddSchool", true, "addSchool");
    }

    function deleteSchool (object, schoolName) {
        ajaxCall("GET", "/admin/doDeleteSchool/" + schoolName, true);
        $(object).closest("tr").remove();
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
                    <td onclick="deleteSchool(this, <?php echo $school['id'];?>)"><img src="/public/img/slettIkon.png" width="35" ></td>
                </tr>
            <?php }  ?>
        </table>
    </div>
</div>