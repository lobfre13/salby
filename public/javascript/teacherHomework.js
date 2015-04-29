function loadSubjectCategories(id){
    document.getElementById("selectedClass").value = id; //remember selected class
    ajaxCall("GET","/teacher/getCategories/"+id, true, "tasksContent");
}

function loadCategoryContent(id){
    ajaxCall("GET","/teacher/getCategoryContent/"+id, true, "tasksContent");
}

function addTask(id){
    var classid = document.getElementById("selectedClass").value;
    ajaxCall("GET","/teacher/addPendingTask/"+id+"/"+classid, false);
    loadPending(classid);
    $('next').style.display = 'initial';
}

function loadPending(id){
    ajaxCall("GET","/teacher/getPendingTasks/"+id, true, "chosen");
}

function nextStep(){
    var classid = document.getElementById("selectedClass").value;
    window.location = "/teacher/choosePupils/"+classid;
}

function loadClass(sel){
    ajaxCall("GET","/teacher/getClass/"+sel.value, true, 'classPupils');
}

function loadClassTasks(sel){
    ajaxCall("GET","/teacher/getClassTasks/"+sel.value, true, 'classTasks');
}

function editTask(taskId){
    ajaxCall("GET","/teacher/editTask/"+taskId, true, 'classTasks');
}
function deleteTask(taskId, row){
    if(confirm('Er du sikker på at du vil slette dette gjøremålet?')){
        ajaxCall("GET","/teacher/deleteTask/"+taskId, true);
        $(row).closest("tr").remove();
    }
}

function markSelected(obj){
    $(obj).siblings().css("background-color", "white");
    $(obj).css("background-color", "#999999");
}