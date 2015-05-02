<script>
    function pupilsFromClass (classId) {
        ajaxCall("GET", "/teacher/pupilsFromClass/" + classId.value, true, "pupilSettingsDiv");
    }
</script>

<div id="content" class="widthConstrained">

    <h3>Dine elever</h3>
    <h3>Velg klasse</h3>
    <select id="selectSubjectDropDown" onchange="pupilsFromClass(this)">
        <?php foreach($this->classes as $class) { ?>
        <option value="<?php echo $class['id'];?>"><?php echo $class['classlevel'] . $class['classname']?></option>
        <?php } ?>
    </select>
    <table id = pupilSettingsDiv>

    </table>

    <script>$( document ).ready(function() {
            $("#selectSubjectDropDown").trigger('onchange');
        });</script>
</div>