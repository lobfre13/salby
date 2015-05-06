<script src="/public/javascript/teacherHomework.js"></script>
    <div id="content" class="widthConstrained">

        <div>
            <select id="selectedClass" onchange="loadClass(this); loadClassTasks(this)" class="styled-select">
                <?php foreach($this->schoolClasses as $class) { ?>
                    <option value="<?php echo $class['id']; ?>"><?php echo $class['classlevel'].$class['classname'].' - '.$class['subjectname'];?></option>
                <?php } ?>
            </select>
        </div>

        <div id="classPupils" class="classStats tableBG"></div>
        <div id="classTasks" class="classStats tableBG"></div>


        <script>$( document ).ready(function() {
               $("#selectedClass").trigger('onchange');
            });</script>

    </div>

