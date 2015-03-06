<div id="content" class="widthConstrained">

    <div id = "homeworkListTop">Lekseliste</div>
    <div id = "homeworkListTop">Velg elev</div>
    <div id = "homeworkListTop">Godkjenn</div>

    <h4>Marker spillene fra listen som du vil legge til i elevens gjøremål</h4>

    <div id = "dropDownMenuClassAndView">
        <select>
            <option value="chooseClass">Velg klasse</option>
            <?php
                foreach ($listOfClasses as $classItem) {
                    echo '<option value ="' . $classItem['classlevel'] . $classItem['classname'] . '">' . $classItem['classlevel'] . $classItem['classname'] . '</option>';
                }
            ?>
        </select>

        <select>
            <option value="view">Visning</option>
            <option value="pictures">Bilder</option>
            <option value="list">Liste</option>
        </select>
    </div>

    <div id = "homeworkListDiv">
        <table>
            <tr>
                <?php
                foreach ($learningObjectList as $learningObjectItem) {
                    echo '<td><img src="' . $learningObjectItem['imgurl'] . '"></td>';
                    echo '<td><input type = "checkbox" name = "' . $learningObjectItem['id'] . '</td>';
                }
                ?>
            </tr>
        </table>
    </div>

    <div id = "continue">
        <p>2 spill er markert, gå videre</p>
        <form method="post">
            <input name = "continue" type="submit" value="Gå videre">
        </form>
    </div>
</div>