<script>

    function deleteUser(obj, username){
        ajaxCall("GET", "/admin/deleteSchoolUser/"+username, true);
        $(obj).closest("tr").remove();
    }

</script>
<div id="content" class="widthConstrained">
    <?php include $this->root."/app/views/admin/PartialViews/adminMenu.php"?>
    <div id="schoolMainTable">
        <h2><?php echo $this->school['name']; ?></h2>

        <form method="post" action="/admin/updateSchool">
            <input name="id" type="hidden" value="<?php echo $this->school['id']; ?>">
            <input name="name" type="text" placeholder="Skolenavn" value="<?php echo $this->school['name']; ?>">
            <input name="fylke" type="text" placeholder="Fylke" value="<?php echo $this->school['fylke']; ?>">
            <input name="kommune" type="text" placeholder="Kommune" value="<?php echo $this->school['kommune']; ?>">
            <input type="submit" value="Oppdater">
        </form>

        <div class="relationTable">
            <h4>Skolebrukere</h4>
            <table>
                <thead>
                    <th>Brukernavn</th>
                    <th>Slett</th>
                </thead>
                <?php foreach($this->schoolUsers as $user) { ?>
                    <tr>
                        <td><?php echo $user['username']?></td>
                        <td onclick="deleteUser(this, '<?php echo $user['username']?>')">X</td>
                    </tr>
                <?php } ?>

            </table>
        </div>
        <div class="relationTable">
            <h4>Legg til skolebruker</h4>
            <form method="post" action="/admin/addSchoolUser">
                <input type="hidden" name="schoolid" value="<?php echo $this->school['id'];?>">
                <input type="text" name="username" placeholder="Brukernavn"><br>
                <input type="password" name="password" placeholder="Passord"><br>
                <input type="email" name="email" placeholder="Epost"><br>
                <input type="submit" value="Legg til skolebruker">
            </form>
        </div>
    </div>
</div>
