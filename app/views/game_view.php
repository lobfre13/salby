
    <div id="AddFavourite">
       <label></label>
            <div id="favIcon" onclick="addFavourite(<?php echo $lobject['id']; ?>)"></div>
   </div>
    <br>
    <iframe seamless src="<?php echo $lobject['link']; ?>" frameborder="none" scrolling="no" onload="resizeIframe(this)"></iframe>

