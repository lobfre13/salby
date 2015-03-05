<div id="content" class="widthConstrained">

    <div id = "homeworkListTop">Lekseliste</div>
    <div id = "homeworkListTop">Velg elev</div>
    <div id = "homeworkListTop">Godkjenn</div>

    <h4>Marker spillene fra listen som du vil legge til i elevens gjøremål</h4>

    <div id = "dropDownMenuClassAndView">
        <select>
            <?php
                foreach ($listOfClasses as $classItem) {
                    echo '<option value ="' . $classItem['classlevel'] . $classItem['classname'] . '">' . $classItem['classlevel'] . $classItem['classname'] . '</option>';
                }
            ?>
        </select>

        <select>
            <option value="test4">test4</option>
            <option value="test5">test5</option>
            <option value="test6">test6</option>
        </select>
    </div>

    <div id = "homeworkListDiv">
        Du har ingen spill i lekselisten
    </div>

    <div id = "continue">
        <p>2 spill er markert, gå videre</p>
        <form method="post">
            <input name = "continue" type="submit" value="Gå videre">
        </form>
    </div>
</div>