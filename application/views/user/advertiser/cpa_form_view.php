<div class="w3-container w3-center">
<span class="w3-serif w3-large w3-text-grey">Form Data</span>

<div class="w3-container">
	<?=form_open_multipart('advertiser_dashboard/cpa_form') ?>
	<?php
if(isset($_SESSION['action_status_report']))
{

	echo "<span class='w3-text-red'>".$_SESSION['action_status_report']."</span>";
}
	?>
	<div class="w3-text-red"><?=validation_errors() ?></div>
	<div class="w3-half">
	<span class="w3-small w3-label w3-margin-top">Form Name (<span class="w3-tiny">Visible to Prospects</span>) </span><br>
<input type="text" class="w3-padding w3-round w3-card w3-margin-bottom" name="form_name" placeholder="Form Name" />
	<br>
</div>
<div class="w3-half"><span class="w3-small w3-label w3-margin-top">Company Name (<span class="w3-tiny">Visible to Prospects</span>) </span><br>
<input type="text" class="w3-padding w3-round w3-card w3-margin-bottom" name="company_name" placeholder="Company Name" />
	<br></div>
	<span class="w3-small w3-label w3-margin-top">Access Type </span><br>
	<select class="w3-padding w3-round w3-card w3-margin-bottom" onchange="checkAccessType(this.value)" name="access_type">
		<option value="free">FREE</option>
		<?php
     if (strtolower($user['country']) == 'nigeria') {
     	echo '<!--<option value="paid">PAID</option>-->';
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
	<div id="pricebox" class="w3-hide w3-cell-row w3-margin">
		<div style="display: inline-block;">
		<select class="w3-padding w3-round w3-card" name="currency">
		<option value="<?=$country_details['currency_code'] ?>"><?=$country_details['currency_code'] ?></option>
		<!--<option value="USD">USD</option>-->
	</select>
		</div>
		<div style="display: inline-block;" class="w3-margin-left">
			<span class="w3-small w3-label">Product Price </span><br>
	<input type="number" class="w3-padding w3-round w3-card" name="product_price" placeholder="Product Price"/>
	<BR>
		</div>

	</div>
		<div>
<div id="rowcontainers" class="w3-container">
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

    <input type="submit" name="Submit" class="w3-button w3-indigo w3-round" value="Next"/>
    </form>



<br>
<script type="text/javascript">

function handleMore(){
var handleMoreBtn = document.getElementById('handleMoreBtn');
var rowcontainers = document.getElementById('rowcontainers');
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
<div class="w3-center">
<hr>
OR
<hr>
   <span class="w3-text-indigo w3-serif">Use Existing CPA Form</span><br>
   <?=form_open('advertiser_dashboard/use_existing_cpa') ?>
   <select name="form" class="w3-padding w3-margin">
   	<?php 
   	foreach ($cpas as $cpa) {
   	echo "<option value='".$cpa['ref_id']."'>".$cpa['name']."</option>";
   	}
   	?>
   </select>
   <input type="submit" name="submit" value="Go" class="w3-btn w3-indigo"/>
</form>
</div>

<br><!--
<div class="w3-container w3-center">
Need Help? Please read this page documentation <a class="w3-text-indigo" href="<?= site_url('blog/page-documentation-creating-new-cpa-campaign') ?>">HERE</a>

</div>-->
<br>