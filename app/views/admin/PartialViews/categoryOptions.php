<option value="" selected disabled>Velg kategori..</option>
<?php foreach($this->categories as $category){ ?>
    <option value="<?php echo $category['id']; ?>"><?php echo $category['category'] ?></option>
<?php } ?>