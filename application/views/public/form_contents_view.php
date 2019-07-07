<div style='margin: 24px;margin-top: 72px;' class="w3-container w3-card-8 w3-center w3-padding">
	<center><div style="max-width: 80%;" class="w3-center">
<div class="w3-center">
	<span class="w3-xlarge w3-text-indigo"><b><?=$cpa_form['name'] ?></b></span> <br><span class='w3-small w3-text-blue'>by</span> <span class="w3-medium w3-text-indigo"><?=$cpa_form['company_name'] ?></span><br>


<a href="<?=site_url('blog/powered_by_custch') ?>"><span class="w3-tag w3-tiny w3-padding w3-red w3-serif w3-margin" style="transform:rotate(-5deg)">
powered by 
Custch
</span></a></div>
<!-- pre content-->
<?php
if ($cpa_form['extra_data_position'] == 'pre_form') {
echo $cpa_form['extra_data'];
}


?>

<!--pre content ends here-->
<?= form_open('cpa_form/submit_form/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)) ?>
<div class="w3-center">
	<!--- form here-->
<?php
if (!empty($cpa_form['form_makeup_data'])) {
	
foreach (json_decode($cpa_form['form_makeup_data'])  as $field) {
switch ($field->field_type) {
	case 'text':
		?>
<input style="max-width: 90%" type="<?=$field->field_names ?>" class="w3-padding w3-margin" name="<?=$field->field_names ?>" placeholder="<?=ucfirst($field->field_names) ?>" required/>

		<?php
		break;
    case 'number':
    ?>
		<input style="max-width: 90%" type="<?=$field->field_type ?>" class="w3-padding w3-margin" name="<?=$field->field_names ?>" placeholder="<?=ucfirst($field->field_names) ?>" required/>
		<?php
		break;
    case 'password':
    ?>
		<input style="max-width: 90%" type="<?=$field->field_type ?>" class="w3-padding w3-margin" name="<?=$field->field_names ?>" placeholder="<?=ucfirst($field->field_names) ?>" required/>
		<?php
		break;
	case 'inbuilt':
		 echo "";
		 break;
    case 'dropdown':
    ?>
    <div style="display: inline-block;" class=''>
 <span class='w3-label'><?=ucfirst($field->field_names)?></span> <br>   <select class="w3-padding w3-margin" name="<?=$field->field_names ?>" required>
 	<option value="">Choose...</option>
    	<?php
    	$field_values = explode(',', $field->field_values);
foreach ($field_values as $value) {

echo "<option value='".$value."'>".strtoupper($value)."</option>";

}

    	?>
    </select>
</div>
		
		<?php
		break;
    case 'checkbox':
    $field_values = explode(',', $field->field_values);
   echo "<div class=''>";
 $field_values = explode(',', $field->field_values);
 echo "<span class='w3-label'>".ucfirst($field->field_names)."</span><br>";
foreach ($field_values as $value) {

echo "<span class='w3-margin'><input type='checkbox' name='".$field->field_names."[]' value='".$value."' /> ".strtoupper($value)."</span>";
		# code...
}
echo "</div>";
	
		break;
    case 'radio':
echo "<div class=''>";
 $field_values = explode(',', $field->field_values);
 echo "<span class='w3-label'>".ucfirst($field->field_names)."</span><br>";
foreach ($field_values as $value) {

echo "<span class='w3-margin'><input type='radio' name='".$field->field_names."' value='".$value."' required/> ".strtoupper($value)."</span>";
		
}
echo "</div>";
			break;
	
	
}

}

}


?>

<!-- post content-->
<div style="max-width: 100%" class="w3-container w3-small w3-center w3-margin">
<?php
if ($cpa_form['extra_data_position'] == 'post_form') {
echo $cpa_form['extra_data'];
}


?>
</div>

<!--post content ends here-->
<div style="max-width: 90%" class="w3-container w3-small w3-center w3-margin w3-text-orang w3-serif w3-border w3-padding">
	By Clicking on Submit,You agree that you are not submitting this form to Custch Advertising Company but to the Advertiser(Company) whose name is shown above.



</div>






<br>


<input type="submit" name="submit" class="w3-btn w3-indigo w3-margin" value="Submit"/>

</div></form>
</div></center></div>