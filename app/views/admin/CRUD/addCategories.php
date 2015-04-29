<form>
    <td><input type="text" name="kategori" placeholder="Kategori"></td>
    <td><input type="file" name="bildeToUpload" id="bildeToUpload" value="Legg til kategoribilde"></td>
    <td><input type="text" name="tilhørendeFag" placeholder="Tilhørende fag"></td>
    <td><input type="text" name="klasseTrinn" placeholder="Klassetrinn"></td>
    <td><div id="addSchoolBtnComplete"></td>
    <td><div onclick="deleteCategory(this, <?php echo $category['id'];?>)" class="deleteBtn"></td>
</form>
