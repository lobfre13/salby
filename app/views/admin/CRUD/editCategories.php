<script>
    function loadSubjects(sel){
        ajaxCall("GET", "/admin/loadSubjects/"+sel.value, true, "subjects");
    }

    function deleteRelation(obj, subID, catID){
        if(confirm("Er du sikker på at du vil fjerne denne relasjonen?")) {
            ajaxCall("GET", "/admin/deleteCategoryRelation/" + subID + "/" + catID, true);
            $(obj).closest("tr").remove();
        }
    }
</script>

<div id="content" class="widthConstrained">
    <?php $this->showNotice();?>
    <?php include $this->root."/app/views/admin/PartialViews/adminMenu.php"?>
    <div class="tableBG">
        <h2><?php echo $this->category['category']; ?></h2>

        <div class="relationTable table">
            <h4>Tilhørende kategorier</h4>
            <table >
                <thead>
                <th>Fag</th>
                <th>Trinn</th>
                <th>Fjern</th>
                </thead>
                <?php foreach($this->categoryRelations as $catRel){ ?>
                    <tr>
                        <td><?php echo $catRel['subjectname']; ?></td>
                        <td><?php echo $catRel['classlevel'].'. klasse'; ?></td>
                        <td onclick="deleteRelation(this, <?php echo $catRel['subjectid']; ?>, <?php echo $this->category['id']; ?>)"><div class="deleteBtn"></div></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="relationTable">
            <div>
                <form method="post" action="/admin/updateCategories" enctype="multipart/form-data">
                    <input name="id" type="hidden" value="<?php echo $this->category['id']; ?>" required>
                    <input name="title" type="text" placeholder="Tittel" value="<?php echo $this->category['category']; ?>" required>
                    <input type="file" name="pic" id="pic">
                    <input type="submit" class="submit" value="Oppdater">
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
                    <option value="7">7. klasse</option>
                </select><br><br>
                <form method="POST" action="/admin/addCategoryRelation/<?php echo $this->category['id']?>">
                    <select name="subject" id="subjects" required class="styled-select">
                        <option value="" disabled selected>Velg fag..</option>
                    </select>
                    <input class="submit" type="submit" value="Legg knytt til kategori">
                </form>
            </div>
        </div>
    </div>
</div>
