
    <div id="AddFavourite">
       <label></label>
            <div id="favIcon" onclick="addFavourite(this, <?php echo $lobject['id']; ?>)" style="background-image: url('<?php echo $favimgurl; ?>')"></div>
   </div>
    <br>
    <iframe seamless src="<?php echo $lobject['link']; ?>" frameborder="none" scrolling="no" onload="resizeIframe(this)"></iframe>

