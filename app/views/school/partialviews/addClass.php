<td><select name="classLevel" class="styled-select" required>
        <option value="" disabled selected>Velg trinn..</option>
        <option value="1">1. klasse</option>
        <option value="2">2. klasse</option>
        <option value="3">3. klasse</option>
        <option value="4">4. klasse</option>
        <option value="5">5. klasse</option>
        <option value="6">6. klasse</option>
        <option value="7">7. klasse</option>
    </select></td>
<td><input type="text" name="className" placeholder="Klassebokstav" maxlength="1" required></td>
<td class="editDeleteColumn"><label class="leggTil" for="submitBtn">Legg til</label> <div id="addClassBtnComplete" onclick="doAddSchoolClass()"><input id="submitBtn" type="submit" class="hide"></div>
<div onclick="$(this).closest('tr').html('')" class="deleteBtn"></div></td>