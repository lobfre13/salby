
    <td><input type="text" name="lOnavn" placeholder="Tittel" required></td>
    <td><input type="text" name="lOIconToUpload" placeholder="Legg til ikon" required></td>
    <td><input type="text" name="lOToUpload" placeholder="Legg til læringsobjekt" required></td>
    <!--
    <td><input type="file" name="lOIconToUpload" id="lOIconToUpload" value="Legg til ikon"></td>
    <td><input type="file" name="lOToUpload" id="lOToUpload" value="Legg til læringsobjekt"></td>
    -->
    <td><div title="Legg til læringsobjekt" id="addSchoolBtnComplete" onclick="doAddLearningObject()"><input id="submitBtn" type="submit" class="hide"></div>
        <div title="Slett læringsobjekt" onclick="$(this).closest('tr').html('')" class="deleteBtn"></div></td>
