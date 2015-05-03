<td><select name="classLevel" class="styled-select">
        <option disabled selected>Velg trinn..</option>
        <option value="1">1. klasse</option>
        <option value="2">2. klasse</option>
        <option value="3">3. klasse</option>
        <option value="4">4. klasse</option>
        <option value="5">5. klasse</option>
        <option value="6">6. klasse</option>
        <option value="7">8. klasse</option>
    </select></td>
<td><input type="text" name="className" placeholder="Klassebokstav"></td>
<td><div id="addClassBtnComplete" onclick="doAddSchoolClass()"></div>
<div onclick="$(this).closest('tr').html('')" class="deleteBtn"></div></td>