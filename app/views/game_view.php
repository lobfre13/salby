<script>
    function updateFavourite(id){
        if (id == "") return;
        else {
            xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET","/main/updateFavourite/?id="+id+"&url="+document.URL, true);
            xmlhttp.send();
        }
    }

    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }
</script>


    <input onchange="updateFavourite(<?php echo $lobject['id']; ?>)" <?php if($isFavourite) echo 'checked';?> id="favIcon" type="checkbox"><label for="favIcon"><span id="favoritTekst">Favoritt</span></label>
    <iframe seamless src="<?php echo $lobject['link']; ?>" frameborder="none" scrolling="no" onload="resizeIframe(this)" width="100%"></iframe>

