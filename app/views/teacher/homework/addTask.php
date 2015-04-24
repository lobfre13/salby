<script>
    function loadSubjectCategories(id){
        document.getElementById("selectedClass").value = id;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("tasksContent").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","/teacher/getCategories/"+id, true);
        xmlhttp.send();
        document.getElementById("tasksContent").innerHTML = "<img width='20' height='20' src='http://www.adobe.com/business/calculator/VIP/image/loader.gif'>"
    }

    function loadCategoryContent(id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("tasksContent").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","/teacher/getCategoryContent/"+id, true);
        xmlhttp.send();
        document.getElementById("tasksContent").innerHTML = "<img width='20' height='20' src='http://www.adobe.com/business/calculator/VIP/image/loader.gif'>"
    }

    function addTask(id){
        var classid = document.getElementById("selectedClass").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET","/teacher/addPendingTask/"+id+"/"+classid, false);
        xmlhttp.send();
        loadPending(classid);
    }

    function loadPending(id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("chosen").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","/teacher/getPendingTasks/"+id, true);
        xmlhttp.send();
        document.getElementById("chosen").innerHTML = "<img width='20' height='20' src='http://www.adobe.com/business/calculator/VIP/image/loader.gif'>"
    }

    function nextStep(){
        var classid = document.getElementById("selectedClass").value;
        window.location = "/teacher/choosePupils/"+classid;
    }

</script>

<div id="content" class="widthConstrained">
    <span class="addTaskIndicator" style="background-color: #00BFD5">Lekseliste</span>
    <span class="addTaskIndicator">Velg elev</span>
    <span class="addTaskIndicator">Godkjenn</span>

    <div id="sideBar">
        <div id="teacherClasses">
            <input id="selectedClass" type="hidden">
            <h4>Dine Klasser</h4>
            <ul>
                <?php foreach($this->schoolClasses as $class) { ?>
                    <li onclick="loadSubjectCategories(<?php echo $class['subjectid']; ?>); loadPending(<?php echo $class['subjectid']; ?>)"><?php echo $class['classlevel'].$class['classname'].' - '.$class['subjectname'];?></li>
                <?php } ?>
            </ul>
        </div>
        <div id="chosen">

        </div>
    </div>


    <div id="tasksContent"><h4>Velg Klasse..</h4>


    </div>

    <input type="button" onclick="nextStep()" value="GÅ VIDERE">

</div>