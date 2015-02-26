
/**
 * Created by PhpStorm.
 * User: Simen Fonnes
 * Date: 26.02.2015
 * Time: 10:47
 */
<ul>
    <?php
        foreach(routeAction() as $homework) {
            echo "<li>$homework</li>";
        }
    ?>
</ul>