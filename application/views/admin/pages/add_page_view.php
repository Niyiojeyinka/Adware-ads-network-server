<div class="w3-twothird">


<div class="w3-center">
<b class="w3-xlarge w3-text-blue-grey">Create New Page:</b><br>
<form action="<?php
echo site_url('admin_blog/add_page');
?>" method="Post">

<span class="w3-text-red"><?php
echo validation_errors(); ?>
</span>
<?php
if(isset($err_reports))
{
	echo $err_reports;

}
?>
<br>
<span class="w3-label">Title:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding"  name="title" value="<?php echo set_value('title'); ?>" placeholder="Page title"></input>
<br><br>





<script type="text/javascript" src="<?= base_url('assets/js/nicEdit.js') ?>"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	
	new nicEditor({iconsPath : '/nicEditorIcons.gif'}).panelInstance('contents');
	
});
</script>

<center>
<span class="w3-label">Contents:</span><br>
<textarea id="contents" placeholder="Page contents" class="w3-center w3-border-blue-grey" name="contents"  value="<?php  echo set_value('contents'); ?>" rows="25" cols="52"></textarea><br>

<br>
<span class="w3-label">Meta Keywords(separated by comma):</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" name="keywords"  value="<?php echo set_value('keywords'); ?>" placeholder="Page Meta Keywords"></input>
<br>

<br>
<span class="w3-label">Meta Description:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" name="desc"  value="<?php echo set_value('desc'); ?>" placeholder="Page Meta Description"></input>
<br>



</center>
<a class="w3-button w3-green" href="<?php echo site_url("media"); ?>">Go to Media</a><br>


</center>

<br>

<input type="submit" class="w3-btn w3-blue" value="Publish" name="submit"></input><br>


</div>