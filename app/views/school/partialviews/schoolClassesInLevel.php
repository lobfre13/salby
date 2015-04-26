<option disabled selected>Velg trinn..</option>
<?php print_r($this->schoolClasses); foreach($this->schoolClasses as $schoolClass) {?>
    <option value="<?php echo $schoolClass['id']; ?>"><?php echo $schoolClass['classname']; ?></option>
<?php }?>