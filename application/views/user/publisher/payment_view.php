<div class="w3-container w3-center">
<span class="w3-text-indigo w3-large w3-serif">Withdrawal Details</span><br>
<?php

if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}

?>
<?= form_open("publisher_dashboard/payment") ?>
<select class="w3-padding w3-border w3-border-indigo" id="payment_type" name="payment_type">
			<option value="choose">Choose....</option>
		<option value="bank">Bank Transfer</option>
	<option value="western_union">Western Union</option>
	<option value="paypal">Paypal</option>
</select>
<br>
<div style="display: none;" class="" id="paypal_div">
<!--- Paypal container---><br>
	<input type="text" name="paypal_email" class="w3-padding w3-border w3-border-indigo" placeholder="Paypal Email" value="<?= $user['bank_acct'] ?>"/>


</div>
<div style="display: none;" class="" id="bank_div">
<!--- bank payment container--->
<div class="w3-container">
<div class="w3-container w3-half">

<h5 class="w3-label">Bank Name</h5>

	<input type="text" name="bank_name" class="w3-padding w3-border w3-border-indigo" placeholder="Bank Name"  value="<?= $user['bank_name'] ?>"/><br>
<h5 class="w3-label">Bank Swift Code</h5>
<input type="text" name="swift_code" class="w3-padding w3-border w3-border-indigo" placeholder="Bank Swift Code"  value="<?= $user['bank_no'] ?>"/><br>
</div>

<div class="w3-container w3-half">
<h5 class="w3-label">Bank Account Name</h5>

	<input type="text" name="account_name" class="w3-padding w3-border w3-border-indigo" placeholder="Bank Account Name"  value="<?= $user['bank_det'] ?>"/><br>
<h5 class="w3-label">Bank Account Number</h5>

	<input type="number" name="account_number" class="w3-padding w3-border w3-border-indigo" placeholder="Bank Account Number"  value="<?= $user['bank_acct'] ?>"/><br>
</div>
</div>
</div>

<div style="display: none;" class="" id="western_div">
<h5 class="w3-label">Address</h5>

	<input type="text" name="address" class="w3-padding w3-border w3-border-indigo" placeholder="Address"  value="<?= $user['bank_acct'] ?>"/><br>
</div>



<input type="submit" name="submit" class="w3-btn w3-indigo w3-margin" value="Save Details"/>


<script type="text/javascript">
	$(document).ready(
		function(){
			$("#payment_type").change(function(){
if($("#payment_type").val() == "bank")
{
$('#bank_div').show();
$('#paypal_div').hide();
$('#western_div').hide();

}else if($("#payment_type").val() == "paypal")
{
$('#paypal_div').show();
$('#bank_div').hide();
$('#western_div').hide();


}else if($("#payment_type").val() == "western_union")
{
$('#western_div').show();
$('#bank_div').hide();
$('#paypal_div').hide();
}
		});
		}
	);

	</script>
</form>
</div>