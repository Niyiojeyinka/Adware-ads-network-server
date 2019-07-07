<div class="w3-container w3-center">
	
	<b class="w3-serif w3-large">Addition Details</b><br>

	<div class="">
		
		<?= form_open('advertiser_dashboard/post_form_addition/'.$this->uri->segment(3)) ?>

<center>
<span class="w3-label">Contents:</span><br>

<script type="text/javascript" src="<?= base_url('assets/js/nicEdit.js') ?>"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	
	new nicEditor({iconsPath : '/nicEditorIcons.gif'}).panelInstance('contents');
	
});
</script>
<style type="text/css">
	
	/*@media screen and (max-width: 600px){
   #contents {
   	width: 100%;
   }
	}
	@media screen and (min-width: 600px){
 #contents {
	width: 55%;
   }
	}*/
</style>
<div class="w3-container">
<textarea  placeholder="Contents" class="w3-center w3-border-blue-grey w3-responsive"
<?php
if ($this->agent->is_mobile()){
	
	//echo 'rows="15" cols="30"';
	echo 'rows="15" style="width: 100%;"';

}else{
	echo 'rows="15" style="width: 50%;"';
}



?>

  id="contents" name="contents"  ><?php  echo set_value('contents'); ?></textarea></div><br>
<span class="w3-label">Position:</span><br>

<select class="w3-padding w3-round" name="position">
	<option value="post_form">Display After The Form</option>
	<option value="pre_form">Display Before The Form</option>

</select>
<br><br>
<span class="w3-label">Usage <span class="w3-label w3-tiny">(What You Want To Use It For):</span></span><br>

<div>
<input type="radio" name="usage" class="w3-radio w3-margin-right w3-center" value="cpa" required/>Cost Per Action(CPA)<br>
<input type="radio" name="usage" class="w3-radio w3-margin-right" value="form" required/>Use as Form<br>
</div></center>
<br>
<input type="submit" name="submit" class="w3-btn w3-indigo w3-round-large w3-margin" value="Next"/>

		
	</div>




</div>
<!--
<div class="w3-container w3-center">
Need Help? Please read this page documentation <a class="w3-text-indigo" href="<?= site_url('blog/page-documentation-form_extra-details') ?>">HERE</a>

</div>-->