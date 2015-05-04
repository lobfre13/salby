
    <td><input type="text" name="kategori" placeholder="Kategori" required></td>
    <td><input type="file" name="pic" id="pic" required></td>
    <td></td>
    <td></td>
    <td><div title="Legg til kategori" id="addSchoolBtnComplete" onclick="doAddCategories()"><input id="submitBtn" type="submit" class="hide">
        </div><div title="Slett kategori" onclick="$(this).closest('tr').html('')" class="deleteBtn"></div>
    </td>
