
<td><input type="text" name="lOnavn" placeholder="Tittel" required></td>
<td></td>
<td><input type="file" name="zip_file" placeholder="Legg til læringsobjekt" required></td>
<td class="editDeleteColumn">
    <label class="leggTil" for="submitBtn">Legg til</label> <div title="Legg til læringsobjekt" id="addSchoolBtnComplete" onclick="doAddLearningObject()"><input id="submitBtn" type="submit" class="hide"></div>
    <div title="Slett læringsobjekt" onclick="$(this).closest('tr').html('')" class="deleteBtn"></div></td>
