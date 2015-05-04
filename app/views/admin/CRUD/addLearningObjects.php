
    <td><input type="text" name="lOnavn" placeholder="Tittel"></td>
    <td><input type="text" name="lOIconToUpload" placeholder="Legg til ikon"></td>
    <td><input type="text" name="lOToUpload" placeholder="Legg til læringsobjekt"></td>
    <!--
    <td><input type="file" name="lOIconToUpload" id="lOIconToUpload" value="Legg til ikon"></td>
    <td><input type="file" name="lOToUpload" id="lOToUpload" value="Legg til læringsobjekt"></td>
    -->
    <td><div title="Legg til læringsobjekt" id="addSchoolBtnComplete" onclick="doAddLearningObject()"></div>
        <div title="Slett læringsobjekt" onclick="$(this).closest('tr').html('')" class="deleteBtn"></div></td>
