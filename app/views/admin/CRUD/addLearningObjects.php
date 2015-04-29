<form>
    <td><input type="text" name="lOnavn" placeholder="Tittel"></td>
    <td><input type="file" name="lOIconToUpload" id="lOIconToUpload" value="Legg til ikon"></td>
    <td><input type="file" name="lOToUpload" id="lOToUpload" value="Legg til læringsobjekt"></td>
    <td><div class="editBtn"></td>
    <td><div onclick="deleteLearningObject(this, <?php echo $learningObject['id'];?>)" class="deleteBtn"></td>
</form>
