<script>
    function getClassesInLevel(classlevel){
        ajaxCall("GET", "/schooladmin/getClasses/"+classlevel.value, true, "chooseClassName");
    }
    function getClassPupils(classid){
        ajaxCall("GET", "/schooladmin/getClassPupils/"+classid.value, true, "classContent")
    }

</script>
<div id="content" class="widthConstrained">
    <?php include 'partialviews/topLinks.php'; ?>

    <h2>Skolens klasser</h2>
    <label for="chooseClassLevel">Velg trinn</label>
    <select id="chooseClassLevel" onchange="getClassesInLevel(this)">
        <option disabled selected>Velg trinn..</option>
        <?php for($i = 1; $i < 8; $i++) {?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?>. klasse</option>
        <?php }?>
    </select>
    <label for="chooseClassName">Velg klasse</label>
    <select id="chooseClassName" onchange="getClassPupils(this)">
        <option disabled selected>Velg klasse..</option>
    </select>

    <div id="classContent" class="tableBG">


    </div>

</div>