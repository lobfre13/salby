
    <div id="AddFavourite">
       <label>Legg til i favoritter:</label>
            <div id="favIcon" onclick="addFavourite(<?php echo $lobject['id']; ?>)"></div>
   </div>
    <br>
    <iframe seamless src="<?php echo $lobject['link']; ?>" frameborder="none" scrolling="no" onload="resizeIframe(this)"></iframe>

