<div class="w3-container w3-twothird">


<div class="w3-center">
<b class="w3-xlarge w3-text-blue-grey">Edit Article:</b><br>
<?= form_open_multipart('admin_blog/edit_post/'.$this->uri->segment(3))?> 
<span class="w3-text-red"><?php
if(isset($_SESSION['err_reports']))
{
	echo $_SESSION['err_reports'];
}
echo validation_errors(); ?>
</span>

<br>
<span class="w3-label">Title:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name='title' value="<?php echo $title; ?>" placeholder="Article title"></input>
<br><br>

<input type="hidden" name="idkey" value="<?php echo $this->uri->segment(3); ?>"></input>


<script type="text/javascript" src="<?= base_url('assets/js/nicEdit.js') ?>"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	
	new nicEditor({iconsPath : '/nicEditorIcons.gif'}).panelInstance('contents');
	
});
</script>




<center>
<span class="w3-label">Contents:</span><br>
<textarea id="contents" placeholder="Article contents" class="w3-center w3-border-blue-grey" name="contents"  value="" rows="25" cols="52"><?php  echo $contents; ?></textarea><br>

<br>
<span class="w3-label">Meta Keywords(separated by comma):</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%" name="keywords"  value="<?php echo $keywords; ?>" placeholder="Post Meta Keywords"></input>
<br>

<br>
<span class="w3-label">Meta Description:</span><br>
<input type="text" class="w3-border-blue-grey w3-padding" style="width:80%;" name="desc"  value="<?php echo $description; ?>" placeholder="Post Meta Description"></input>
<br>



</center>
<span class="w3-label">Feature Image:</span><br>
<input type="file" class="w3-border-blue-grey w3-padding" style="width:60%;" name="fimg"  ></input><br>
<br>
<span class="w3-label">Category:</span><br>
<select class="w3-padding" name='category'>
	<option value="">No Category</option>
	<option value="Documentation">Documentation</option>
	<option value="How_Tos">How Tos</option>
	<option value="Advertising">Advertising</option>
	<option value="Marketing">Marketing</option>
	<option value="Business">Business</option>
		<option value="New_Upadte">New Update</option>
	<option value="New_Feature">New Feature</option>


</select>
<br><br>
<a class="w3-button w3-green w3-margin" href="<?php echo site_url("media"); ?>">Go to Media</a><br>

<input type="submit" class="w3-btn w3-blue" value="Update" name="submit"></input><br>
<form>

</div>
