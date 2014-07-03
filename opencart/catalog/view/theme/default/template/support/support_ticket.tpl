<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
    <?php if ( isset($session_id_hash) && $session_id_hash ) { ?>
        <span style="display: none" id="oc_token"><?php echo $session_id_hash ?></span>
        <iframe src="<?php echo $final_url; ?>" id="osticket" style="width: 100%; margin: 0; padding: 0; border: 0">
        </iframe>
    <?php } else { ?>
        <h2>Please login</h2>
    <?php } ?>
</div>
<script type="text/javascript">
    function autoresize() {
        $('iframe#osticket').iframeAutoHeight();
    }
    autoresize();
</script>
<?php echo $footer; ?>