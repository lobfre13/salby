<form>
    <td><input type="text" name="skolenavn" placeholder="Skolenavn" class="addSchoolForm"></td>
    <td><input type="text" name="fylke" placeholder="Fylke" class="addSchoolForm"></td>
    <td><input type="text" name="kommune" placeholder="Kommune" class="addSchoolForm"></td>
    <td><div id="addSchoolBtnComplete" onclick="actuallyAddSchool(this, <?php echo $school['name']; echo $school['fylke']; echo $school['kommune'];?>)"></td>
    <td><div class="deleteBtn"></td>
</form>
