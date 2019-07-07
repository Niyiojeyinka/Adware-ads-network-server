<div class="w3-container w3-center">
	
	<b class="w3-serif w3-large">Edit Addition Details</b><br>
  <a class="w3-button w3-indigo w3-round-large" href="<?=site_url('advertiser_dashboard/edit_cpa_form/'.$this->uri->segment(3)) ?>"><i class="w3-small w3-serif">Go Back</i></a>
<br>

<div class="w3-container w3-padding">
	
	<a href="<?=site_url('cpa_form/index/'.$cpa_elements['form_slug']) ?>"><i class='fa fa-eye w3-text-green w3-xxlarge'></i></a>
</div>
<?php
if (isset($_SESSION['action_status_report'])) {
	echo $_SESSION['action_status_report'];
}

?>
	<div class="">
		
		<?= form_open('advertiser_dashboard/edit_post_form_addition/'.$this->uri->segment(3)) ?>

<center>
<span class="w3-label">Contents:</span><br>

<script type="text/javascript" src="<?= base_url('assets/js/nicEdit.js') ?>"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	
	new nicEditor({iconsPath : '/nicEditorIcons.gif'}).panelInstance('contents');
	
});
</script>


<textarea  placeholder="Contents" class="w3-center w3-border-blue-grey w3-responsive" rows="15" style="width: 65%;" id="contents" name="contents"  ><?php  echo $cpa_elements['extra_data']; ?></textarea><br>
<span class="w3-label">Position:</span><br>

<select class="w3-padding w3-round" name="position">
	<?php
if ($cpa_elements['extra_data_position'] == 'post_form') {
$select_post_form ='selected';
$select_pre_form =NULL;

}else{
	$select_post_form =NULL;
$select_pre_form ='selected';

}

	?>
		<option value="pre_form" <?=$select_pre_form ?>>Display Before The Form</option>

	<option value="post_form" <?=$select_post_form ?>>Display After The Form</option>

</select>
<br>
<input type="submit" name="submit" class="w3-btn w3-indigo w3-round-large w3-margin" value="Update">

</center>
		
	</div>




</div><!--
<div class="w3-container w3-center">
Need Help? Please read this page documentation <a class="w3-text-indigo" href="<?= site_url('blog/page-documentation-form_extra-details') ?>">HERE</a>

</div>-->