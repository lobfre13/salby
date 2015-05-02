<script>
    function pupilsFromClass (classId) {
        ajaxCall("GET", "/teacher/pupilsFromClass/" + classId.value, true, "pupilSettingsDiv");
    }
</script>

<div id="content" class="widthConstrained">

    <h3>Dine elever</h3>
    <select id="selectSubjectDropDown" onchange="pupilsFromClass(this)" class="styled-select">
        <?php foreach($this->classes as $class) { ?>
        <option value="<?php echo $class['id'];?>">Klasse <?php echo $class['classlevel'] . $class['classname']?></option>
        <?php } ?>
    </select>
    <div class="tableBG">
    <table id = pupilSettingsDiv>

    </table>
    </div>


    <script>$( document ).ready(function() {
            $("#selectSubjectDropDown").trigger('onchange');
        });</script>
</div>