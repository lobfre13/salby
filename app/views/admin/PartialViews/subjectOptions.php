<option value="" selected disabled>Velg fag..</option>
<?php foreach($this->subjects as $subject){ ?>
    <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subjectname'] ?></option>
<?php } ?>