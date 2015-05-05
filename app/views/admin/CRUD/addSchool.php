
    <td><input type="text" name="skolenavn" placeholder="Skolenavn" class="addSchoolForm" required></td>
    <td><input type="text" name="fylke" placeholder="Fylke" class="addSchoolForm" required></td>
    <td><input type="text" name="kommune" placeholder="Kommune" class="addSchoolForm" required></td>
    <td class="editDeleteColumn"><label class="leggTil" for="submitBtn">Legg til</label><div title="Legg til skole" id="addSchoolBtnComplete" onclick="doAddSchool()"><input id="submitBtn" type="submit" class="hide"></div>
        <div title="Slett skole" onclick="$(this).closest('tr').html('')" class="deleteBtn"></div>
    </td>