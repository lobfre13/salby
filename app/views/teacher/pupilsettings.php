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
        <table id="pupilSettingsDiv">

        </table>
    </div>
    <a id="returnToMainPage" href="/teacher"><img src="/public/img/pil.png" width="15px">Tilbake til forside</a>

    <script>$( document ).ready(function() {
            $("#selectSubjectDropDown").trigger('onchange');
        });</script>
</div>