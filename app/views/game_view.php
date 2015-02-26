<div id="content" class="widthConstrained">
    <div id="game" class="subjectContent">
        <h2><?php echo $lobject['title']; ?></h2>
        <form method="post">
            <label>Legg til i favoritter: <input type="submit" name="favoritter" value = "<3"></label>
        </form>

        <h1>Her er læringsobjektet.</h1>

        <iframe seamless src="<?php echo $lobject['link']; ?>" frameborder="none" scrolling="no" onload="resizeIframe(this)"></iframe>
    </div>
</div>

<script language="javascript" type="text/javascript">
    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        obj.style.width = obj.contentWindow.document.body.scrollWidth + 'px';
    }
</script>