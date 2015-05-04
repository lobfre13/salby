
    <td><input type="text" name="fagnavn" placeholder="Fag"></td>
    <td><input type="text" name="klasseTrinn" placeholder="Klassetrinn"></td>
    <td><input type="file" name="pic" id="pic"></td>
    <td>
        <div title="Legg til fag" id="addSchoolBtnComplete" onclick="doAddSubject()"></div>
        <div title="Slett fag" onclick="$(this).closest('tr').html('')" class="deleteBtn"></div>
    </td>

