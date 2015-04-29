<form>
    <td><input type="text" name="fagnavn" placeholder="Fag"></td>
    <td><input type="text" name="klasseTrinn" placeholder="Klassetrinn"></td>
    <td><input type="file" name="fileToUpload" id="fileToUpload" value="Legg til ikon"></td>
    <td><div id="addSchoolBtnComplete"></td>
    <td><div onclick="deleteSubject(this, <?php echo $subject['subjectid'];?>)" class="deleteBtn"></td>
</form>
