<?php
    if(isset($this->optionalCategory))
        echo '<option value="" selected>Ingen foreldrekategori</option>';
    else
        echo '<option value="" selected disabled>Velg kategori..</option>';
    foreach($this->categories as $category){ ?>
    <option value="<?php echo $category['id']; ?>"><?php echo $category['category'] ?></option>
<?php } ?>