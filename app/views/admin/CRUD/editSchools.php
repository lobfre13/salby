<script>

    function deleteUser(obj, username){
        if(confirm("Er du sikker på at du vil slette denne brukeren?")){
            ajaxCall("GET", "/admin/deleteSchoolUser/"+username, true);
            $(obj).closest("tr").remove();
        }

    }

</script>
<div id="content" class="widthConstrained">
    <?php include $this->root."/app/views/admin/PartialViews/adminMenu.php"?>
    <div class="tableBG">
        <h2 id="mainHeadline"><?php echo $this->school['name']; ?></h2>

        <div class="relationTable table">
            <h4>Skolebrukere</h4>
            <table>
                <thead>
                <th>Brukernavn</th>
                <th></th>
                </thead>
                <?php foreach($this->schoolUsers as $user) { ?>
                    <tr>
                        <td><?php echo $user['username']?></td>
                        <td class="deleteBtn" title="Slett skolebruker" onclick="deleteUser(this, '<?php echo $user['username']?>')"></td>
                    </tr>
                <?php } ?>

            </table>
        </div>


        <div class="relationTable">
            <div>
                <h4>Endre skole</h4>
                <form method="post" action="/admin/updateSchool">
                    <input name="id" type="hidden" value="<?php echo $this->school['id']; ?>" required>
                    <input required class="smoothInputField" name="name" type="text" placeholder="Skolenavn" value="<?php echo $this->school['name']; ?>">
                    <input required class="smoothInputField" name="fylke" type="text" placeholder="Fylke" value="<?php echo $this->school['fylke']; ?>">
                    <input required class="smoothInputField" name="kommune" type="text" placeholder="Kommune" value="<?php echo $this->school['kommune']; ?>">
                    <input class="submit" type="submit" value="Endre">
                </form>
            </div>


            <div >
                <h4>Legg til ny bruker</h4>
                <form method="post" action="/admin/addSchoolUser">
                    <input type="hidden" name="schoolid" value="<?php echo $this->school['id'];?>">
                    <input class="smoothInputField" type="text" name="username" placeholder="Brukernavn" required><br>
                    <input class="smoothInputField" type="password" name="password" placeholder="Passord" required><br>
                    <input class="smoothInputField" type="email" name="email" placeholder="E-post" required>
                    <input class="submit" type="submit" value="Legg til">
                </form>
            </div>
        </div>
    </div>
</div>
