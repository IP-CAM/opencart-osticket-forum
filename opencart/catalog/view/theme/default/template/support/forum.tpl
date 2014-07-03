<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
    <span style="display: none" id="oc_token"><?php echo $session_id_hash ?></span>
    <span style="display: none" id="oc_ref"><?php echo $oc_ref ?></span>
    <iframe src="<?php echo $forum_url; ?>" class="forum" style="width: 100%; margin: 0; padding: 0; border: 0" scrolling="yes">
    </iframe>
</div>
<script type="text/javascript">
    function autoresize() {
        $('iframe.forum').iframeAutoHeight();
    }
    autoresize();
</script>
<?php echo $footer; ?>