
    <td><input type="text" name="fagnavn" placeholder="Fag" required></td>
    <td><input type="text" name="klasseTrinn" placeholder="Klassetrinn" required></td>
    <td><input type="file" name="pic" id="pic" required></td>
    <td class="editDeleteColumn">
        <label class="leggTil" for="submitBtn">Legg til</label><div title="Legg til fag" id="addSchoolBtnComplete" onclick="doAddSubject()"><input id="submitBtn" type="submit" class="hide"></div>
        <div title="Slett fag" onclick="$(this).closest('tr').html('')" class="deleteBtn"></div>
    </td>

