<div class="w3-twothird">


<div class="w3-center">
<b class="w3-xlarge w3-text-blue-grey">Post BKI Advert:</b><br>

<?php

echo form_open_multipart('admin_blog/add_advert');

?>
<span class="w3-text-red"><?php
echo validation_errors(); ?>
</span>
<?php
if(isset($_SESSION['action_status_report']))
{

	echo $_SESSION['action_status_report'];

}
?>
<br>
<span class="w3-label">Title:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name="title" value="<?php echo set_value('title'); ?>" placeholder="Advert title"></input>
<br><br>





<script type="text/javascript" src="<?= base_url('assets/js/nicEdit.js') ?>"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	
	new nicEditor({iconsPath : '/nicEditorIcons.gif'}).panelInstance('contentss');
	
});
</script>



<center>


<span class="w3-label">Contents:<br>(<span class="w3-small">Will Be Shown On Banner Shared By Users and must be less than 200 characters</span>):</span><br>
<textarea id="contents" placeholder="Advert contents" class="w3-center w3-border-blue-grey" name="contents" rows="5" cols="52" max="200" ><?php  echo set_value('contents'); ?></textarea><br>

<br>
<span class="w3-label">Category:</span><br>
<select class="w3-padding" name='category'>
	<option value="Advertisement">Advertisement</option>
</select>
<br>


</center>
<input type="submit" class="w3-btn w3-blue" value="Publish Advert" name="submit"></input><br>


</div>