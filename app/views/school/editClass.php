<script>
    function deleteUser(obj, username){
        if(confirm("Er du sikker på at du vil slette denne brukeren?")){
            ajaxCall("GET", "/schooladmin/deleteUser/"+username, true);
            $(obj).closest('tr').remove();
        }
    }

</script>

<div id="content" class="widthConstrained">
    <?php $this->showNotice();?>
    <div class="tableBG">
        <section id="klasse">
            <h2>Klasse <?php echo $this->class['classlevel'].$this->class['classname']; ?></h2>

            <div id="relationTable">
                <h4>Elever i klassen</h4>
                <table>
                    <tr>
                        <th>Fornavn</th>
                        <th>Etternavn</th>
                        <th>Brukernavn</th>
                        <th>Passord</th>
                        <th>Slett</th>
                    </tr>
                    <?php foreach($this->pupils as $pupil){ ?>
                        <tr>
                            <td><?php echo $pupil['firstname']; ?></td>
                            <td><?php echo $pupil['lastname']; ?></td>
                            <td><?php echo $pupil['username']; ?></td>
                            <td><?php echo $pupil['password']; ?></td>
                            <td onclick="deleteUser(this, '<?php echo $pupil['username']; ?>')"><div class="deleteBtn"></div></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </section>
        <div id="rightColumn">
            <div id="addStudent">
                <h4>Legg til elev</h4>
                <form method="POST" action="/schooladmin/addNewPupilToClass/">
                    <input type="hidden" name="classId" value="<?php echo $this->class['id']; ?>">
                    <input type="text" name="firstName" placeholder="Fornavn" required>
                    <input type="text" name="lastName" placeholder="Etternavn" required>
                    <input class="submit" type="submit" value="Legg til elev">
                </form>
            </div>
            <div id="kontaktlaerer">
                <h4>Kontaktlærer: <?php echo $this->mainTeacher['firstname'].' '.$this->mainTeacher['lastname']; ?></h4>

                <form method="POST" action="/schooladmin/updateMainTeacher/">
                    <input type="hidden" name="classId" value="<?php echo $this->class['id']; ?>">
                    <select class="styled-select" name="mainTeacher" required>
                        <option value="" disabled selected>Velg ny kontaktlærer..</option>
                        <?php foreach($this->schoolTeachers as $teacher) { ?>
                            <option value="<?php echo $teacher['username']; ?>"><?php echo $teacher['firstname'].' '.$teacher['lastname']; ?></option>
                        <?php } ?>
                    </select>
                    <input class="submit" type="submit" value="Oppdater">
                </form>
            </div>
        </div>

    </div>
</div>
