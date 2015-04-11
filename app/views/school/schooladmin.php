<div id="content" class="widthConstrained">
    <a href="#skoleklasser">Klasser</a>
    <a href="#brukeradmin">Lærerbrukere</a>

    <div id="skoleklasser" class="schooladminpage">
        <p>Registreringsnummer: <?php echo $this->regkey;?></p>
        <h2>Klasser:</h2>

        <?php
        for($i = 1; $i <= 10; $i++){ ?>
            <div class="blurWrapper">
                <div class="blur"></div>
                <div class="schoolclasses">
                    <h3><?php echo $i;?>.Klasse</h3>
                    <table>
                        <tr>
                            <th>Klasse</th>
                            <th>Antall Elever</th>
                            <th>Kontaktlærer</th>
                        </tr>
                        <?php foreach($this->schoolClasses as $schoolClass){
                            if($schoolClass['classlevel'] == $i){ ?>
                                <tr>
                                    <td><?php echo $schoolClass['classname']; ?></td>
                                    <td>0</td>
                                    <td><?php echo $schoolClass['username']; ?></td>
                                </tr>
                            <?php } }?>
                    </table>
                    <hr>
                    <form method="post">
                        <input type="text" name="classname" size="2" maxlength="1" required pattern="[A-Z]">
                        <select name="mainteacher">
                            <?php foreach($this->teachers as $teacher){ ?>
                            <option value="<?php echo $teacher['username'].'">'.$teacher['username']; ?></option>
                                    <?php } ?>
                                </select>
                            <input type="hidden" value="<?php echo $i; ?>" name="classlevel">
                            <input type="submit" value="Opprett klasse">
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="brukeradmin" class="schooladminpage">

        <table>
            <tr>
                <?php
                foreach($this->teachers as $teacher){
                    echo '<td>'.$teacher['username'].'</td>';
                }
                ?>
            </tr>

        </table>
        <form>
            <input type="text">
            <input type="submit">
        </form>

    </div>

</div>