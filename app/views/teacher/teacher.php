<script>
    function loadClass(sel){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("classPupils").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","/teacher/getClass/"+sel.value, true);
        xmlhttp.send();
    }

    function loadClassTasks(sel){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("classTasks").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","/teacher/getClassTasks/"+sel.value, true);
        xmlhttp.send();
    }

    function editTask(taskId){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("classTasks").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","/teacher/editTask/"+taskId, true);
        xmlhttp.send();
    }
    function deleteTask(taskId, row){
        if(confirm('Er du sikker på at du vil slette dette gjøremålet?')){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET","/teacher/deleteTask/"+taskId, true);
            xmlhttp.send();
            $(row).closest("tr").remove();
        }
    }

</script>
    <div id="content" class="widthConstrained">
        <a class="mainTeacherNavLinks" href="/teacher/addtask/">Legg til Gjøremål</a>
        <a class="mainTeacherNavLinks" href="/teacher/pupilsettings/">Innstillinger for elever</a>
        <a class="mainTeacherNavLinks" href="/teacher/teacherpages/">Lærerside</a>


        <div>
            <h3>Dine klasser</h3>
            <label>Velg klasse
                <select onchange="loadClass(this); loadClassTasks(this)">
                    <option disabled selected>Velg klasse..</option>
                    <?php foreach($this->schoolClasses as $class) { ?>
                        <option value="<?php echo $class['id']; ?>"><?php echo $class['classlevel'].$class['classname'].' - '.$class['subjectname'];?></option>
                    <?php } ?>
                </select>
            </label>
        </div>

        <div id="classPupils" class="classStats"></div>
        <div id="classTasks" class="classStats"></div>




    </div>

