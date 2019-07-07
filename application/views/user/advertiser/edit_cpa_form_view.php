<div class="w3-container w3-center">

<div class="w3-bar w3-white w3-border">
  <button class="w3-bar-item w3-button" onclick="openDiv('cpa_form')"><i class="w3-small w3-serif">Add Form Field/ Edit CPA</i></button>
  <button class="w3-bar-item w3-button w3-border-left w3-border-right" onclick="openDiv('form_field')"><span class="w3-small w3-serif">Edit Existing Form Fields</span></button>
  <a class="w3-bar-item w3-button" href="<?=site_url('advertiser_dashboard/edit_post_form_addition/'.$this->uri->segment(3)) ?>"><i class="w3-small w3-serif">Edit Additional Details</i></a>
</div>
<div class="w3-container w3-padding">
	
	<a href="<?=site_url('cpa_form/index/'.$form['form_slug']) ?>"><i class='fa fa-eye w3-text-green w3-xxlarge'></i></a>
</div>
<div id="cpa_form" class="cpa_editing">
  






<span class="w3-serif w3-large w3-text-grey">Edit Form</span>

<div class="w3-container">
	<?=form_open_multipart('advertiser_dashboard/edit_cpa_form_first_section/'.$this->uri->segment(3)) ?>
	<?php
if(isset($_SESSION['action_status_report']))
{

	echo "<span class='w3-text-red'>".$_SESSION['action_status_report']."</span>";
}
	?>
	<div class="w3-text-red"><?=validation_errors() ?></div>
	<div class="w3-half">
	<span class="w3-small w3-label w3-margin-top">Form Name (<span class="w3-tiny">visible to prospects</span>) </span><br>
<input type="text" class="w3-padding w3-round w3-card w3-margin-bottom" name="form_name" placeholder="Form Name" 
value="<?=$form['name'] ?>" />
	<br>
</div>
<div class="w3-half"><span class="w3-small w3-label w3-margin-top">Company Name (<span class="w3-tiny">visible Prospects</span>) </span><br>
<input type="text" class="w3-padding w3-round w3-card w3-margin-bottom" name="company_name" placeholder="Company Name" value="<?=$form['company_name'] ?>" />
	<br></div>
	<span class="w3-small w3-label w3-margin-top">Access Type </span><br>
	<select class="w3-padding w3-round w3-card w3-margin-bottom" onchange="checkAccessType(this.value)" name="access_type" disabled>
<?php 
if ($form['access_type'] == 'free') {
 $selectfree = 'selected';
 $selectpaid = NULL;
}else{
 $selectpaid = 'selected';
 $selectfree = NULL;

}
?>

		<option value="free" <?=$selectfree ?>>FREE</option>
		<?php
     if (strtolower($user['country']) == 'nigeria') {
     	echo '<option value="paid" '.$selectpaid.'>PAID</option>';
     }else{
     	$displayErr ="<div class='w3-small w3-text-red'>Sorry Paid Product Not Supported in your country Yet<br>
     	You can send us an email via Support@custch.com</div>";
     }
		?>
	</select>
	<br>
	<?php
       if (isset($displayErr)) {
       	echo $displayErr;
       }
	?>
	<div id="pricebox" class="<?php
if($form['access_type'] == 'free')
{
	echo 'w3-hide';
}
	    ?> w3-cell-row w3-margin">
		<div style="display: inline-block;">
		<select class="w3-padding w3-round w3-card" name="currency">
		<option value="<?=$country_details['currency_code'] ?>"><?=$country_details['currency_code'] ?></option>
		<!--<option value="USD">USD</option>-->
	</select>
		</div>
		<div style="display: inline-block;" class="w3-margin-left">
			<span class="w3-small w3-label">Product Price </span><br>
	<input type="number" class="w3-padding w3-round w3-card" name="product_price" value="<?=$form['price'] ?>" />
	<BR>
		</div>

	</div>
		<div>





			<div id="rowcontainers2" class="w3-container">
</div>
<div id="rowcontainers" class="w3-container w3-hide">
	<div id="holdline">
			<div class="w3-cell-row">
				<div class="w3-third">
<span class="w3-tiny w3-label w3-margin">Field Type</span><br>

<select id="type1" class="w3-padding w3-margin" name="type[]" onclick="postSelectAction(this.value,'type1','field1','fieldselectitem1','fieldvalues1')">
	<option value="text">Text</option>
	<option value="password">Password</option>
	<option value="number">Number</option>
	<option value="dropdown">Dropdown</option>
	<option value="radio">Radio</option>
	<option value="checkbox">Checkbox</option>


</select>
		</div><div class="w3-third">

<span class="w3-tiny w3-label w3-margin">Field Name</span><br>

			<input id="field1" type="text" name="field_name[]" placeholder="Field Name E.G FIRST NAME" class="w3-padding w3-margin" />
</div><div class="w3-third">
<span  style="display: none;"   id='fieldvalues1' class="w3-tiny w3-label">Field Value(s)</span><br>


            <input style="display: none" id="fieldselectitem1" type="text" name="fieldselectitem[]" placeholder="Separated by comma E.G music,sport" class="w3-padding" />

</div>
</div>
</div>
</div>




			<br>
			<input id="handleMoreBtn" type="hidden" name="no_field" value="2">
	<input  type="button" onclick="handleMore()" name="2" class="w3-btn w3-round w3-indigo w3-margin w3-small" value="Add Field +"/>	

		</div>

    <input type="submit" name="Submit" class="w3-button w3-indigo w3-round" value="Update"/>
    </form>



<br>
<script type="text/javascript">

function handleMore(){
var handleMoreBtn = document.getElementById('handleMoreBtn');
var rowcontainers = document.getElementById('rowcontainers2');
var row = document.getElementById('holdline');

var newrow = row.innerHTML;
newrow = newrow.replace(/1/g,handleMoreBtn.value);
rowcontainers.insertAdjacentHTML('beforeend',newrow);

handleMoreBtn.value= (Number(handleMoreBtn.value) + 1).toString();
}

	function postSelectAction(input_value,type_box_id,target_field,field_values,fieldvaluesdiv){
//change placeholder
var target_field = document.getElementById(target_field);
var field_values = document.getElementById(field_values);
var value_div = document.getElementById(fieldvaluesdiv);
switch(input_value){
	case 'text':
	target_field.setAttribute("placeholder","Field Name E.G FIRST NAME");
	 field_values.style.display ='none';
	value_div.style.display ='none';

	break;
	case 'password':
	target_field.setAttribute("placeholder","Field Name E.G Account Password");
	 field_values.style.display ='none';
		value_div.style.display ='none';


	break;
	case 'number':
		target_field.setAttribute("placeholder","Field Name E.G PHONE NUMBER");
		field_values.style.display ='none';
			value_div.style.display ='none';



    break;
    case 'dropdown':
		target_field.setAttribute("placeholder","Field Name E.G Category");
		//show select item of the field here
		field_values.style.display ='Block';
		value_div.style.display ='Block';


    break;
     case 'radio':
		target_field.setAttribute("placeholder","Field Name E.G Gender");
		//show select item of the field here
		field_values.style.display ='Block';
		value_div.style.display ='Block';


    break;

 case 'checkbox':
		target_field.setAttribute("placeholder","Field Name E.G Languages");
		//show select item of the field here
		field_values.style.display ='Block';
		value_div.style.display ='Block';

    break;
    default :
    			value_div.style.display ='none';

    	break;

}





	}
	function checkAccessType(access_value) {
     var pricebox = document.getElementById("pricebox");
if(access_value == "paid")
{
 pricebox.className = pricebox.className.replace("w3-hide", "");

	}else{
		 pricebox.className += " w3-hide";

	}
}
</script>

</div>










</div>


<div id="form_field" class="cpa_editing" style="display:none">
  

<div>
	<?= form_open('advertiser_dashboard/edit_form_field/'.$this->uri->segment(3)) ?>
	<span class="w3-serif w3-large w3-text-grey">Edit Existing Form Field</span><br>





<?php


echo "<center><table style='max-width:50%;' class='w3-table w3-striped w3-center'>";
echo "<tr><th>Action</th><th>Field Name</th><th>Field Type</th></tr>";
$count = 0;
foreach (json_decode($form['form_makeup_data'],true) as $each_field) {

echo "<tr>";
echo "<td>";
if($each_field['field_type'] !='inbuilt'){
echo "<input type='checkbox'  name='".$count."' class='w3-padding' />";
}else{
	//disable select for inbuilt variable
	echo "<input type='checkbox'  name='".$count."' class='w3-padding' disabled/>";

}
echo "</td>";
echo "<td>";
echo "<span class='w3-padding'>";
echo ucfirst($each_field['field_names']);
echo "  Field</span>";
echo "</td>";
echo "<td>";
echo "<span class='w3-padding'>";
echo ucfirst($each_field['field_type']);
echo "</span>";
echo "</td>";
echo "</tr>";
$count++;
}
echo "<input type='hidden' name='no_field' value='".($count+1)."'/>";
echo "</table></center>";
echo "<div class='w3-bar w3-border w3-margin'>";
echo "<button name='delete' class='w3-button w3-bar-item w3-white  w3-text-red'><i class='fa fa-close'></i> Delete</button>";
echo "</div></form>";

//var_dump(json_decode($form['form_makeup_data'],true));



?>



</div>

</div>








<script type="text/javascript">
function openDiv(cityName) {
     var i;
    var x = document.getElementsByClassName("cpa_editing");
     for (i = 0; i < x.length; i++) {
         x[i].style.display = "none"; 
    }
     document.getElementById(cityName).style.display = "block"; 
}


</script>














</div>

<br>
<div class="w3-container w3-center">
Need Help? Please read this page documentation <a class="w3-text-indigo" href="<?= site_url('blog/page-documentation-creating-new-cpa-campaign') ?>">HERE</a>

</div>
<br>