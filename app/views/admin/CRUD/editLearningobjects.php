<script>
    function loadSubjects(sel){
        ajaxCall("GET", "/admin/loadSubjects/"+sel.value, true, "subjects");
    }

    function loadCategories(sel){
        ajaxCall("GET", "/admin/loadCategories/"+sel.value, true, "categories");
    }

    function deletelObjectRelation(obj, catID, lObjectID){
        if(confirm("Er du sikker på at du vil fjerne denne relasjonen?")){
            ajaxCall("GET", "/admin/deletelObjectRelation/"+catID+"/"+lObjectID, true);
            $(obj).closest("tr").remove();
        }

    }
</script>

<div id="content" class="widthConstrained">
    <?php include $this->root."/app/views/admin/PartialViews/adminMenu.php"?>
    <div class="tableBG">
        <h2><?php echo $this->lObject['title']; ?></h2>
        <div class="relationTable table">
            <h4>Tilhørende kategorier</h4>
            <table >
                <tr>
                    <th>Kategori</th>
                    <th>Fag</th>
                    <th>Trinn</th>
                    <th>Fjern</th>
                </tr>
                <?php foreach($this->lObjectRelations as $lORel){ ?>
                    <tr>
                        <td><?php echo $lORel['category']; ?></td>
                        <td><?php echo $lORel['subjectname']; ?></td>
                        <td><?php echo $lORel['classlevel'].'. klasse'; ?></td>
                        <td onclick="deletelObjectRelation(this, <?php echo $lORel['catid']; ?>, <?php echo $this->lObject['id']; ?>)">X</td>
                    </tr>
                <?php } ?>
            </table>
        </div>


        <div class="relationTable">
            <div>

                <form method="post" action="/admin/updateLObject">
                    <input name="id" type="hidden" value="<?php echo $this->lObject['id']; ?>" required>
                    <input name="title" type="text" placeholder="Tittel" value="<?php echo $this->lObject['title']; ?>" required>
                    <input name="icon" type="text" placeholder="Icon" value="<?php echo $this->lObject['imgurl']; ?>" required>
                    <input name="link" type="text" placeholder="Læringsobject" value="<?php echo $this->lObject['link']; ?>" required><br>
                    <input class="submit" type="submit" value="Oppdater">
                </form>
            </div>


            <div>
                <h4>Legg til relasjon</h4><br>
                <select name="classlevel" onchange="loadSubjects(this)" class="styled-select">
                    <option disabled selected>Velg trinn..</option>
                    <option value="1">1. klasse</option>
                    <option value="2">2. klasse</option>
                    <option value="3">3. klasse</option>
                    <option value="4">4. klasse</option>
                    <option value="5">5. klasse</option>
                    <option value="6">6. klasse</option>
                    <option value="7">8. klasse</option>
                </select><br><br>
                <select name="subject" onchange="loadCategories(this)" id="subjects" class="styled-select">
                    <option disabled selected>Velg fag..</option>
                </select><br><br>
                <form method="POST" action="/admin/addlObjectRelation/<?php echo $this->lObject['id']?>">
                    <select name="category" id="categories" required class="styled-select">
                        <option value="" selected disabled>Velg kategori..</option>
                    </select><br>
                    <input class="submit" type="submit" value="Legg til relasjon">

                </form>


            </div>
        </div>
    </div>
</div>
