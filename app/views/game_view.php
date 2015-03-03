
<script>
    document.getElementById("path").innerHTML = "lal";
</script>
<h5 id="path"></h5>
    <div id="AddFavourite">
       <label>Legg til i favoritter:</label>
            <div id="favIcon" onclick="addFavourite(<?php echo $lobject['id']; ?>)"></div>
   </div>
    <iframe seamless src="<?php echo $lobject['link']; ?>" frameborder="none" scrolling="no" onload="resizeIframe(this)"></iframe>

