<div class="w3-container w3-center">
<span class="w3-text-indigo w3-large w3-serif">Account Deposit</span><br>
<?php
if(isset($_SESSION['action_status_report']))
{

	echo $_SESSION['action_status_report']."<br>";
}

?>
<?= form_open('advertiser_dashboard/payment') ?>
<span class="w3-medium">Please choose currency you want to be bill in</span><br>
<select name="currency" class="w3-padding">
	<option value="usd">US Dollar</option>
		<option value="zar">South African Rand</option>
	<option value="NGN">Nigerian Naira</option>
	<option value="ugx">Ughanda Shilling</option>
		<option value="kes">Kenya Shilling</option>
		<option value="ghs">Ghana Cedi</option>
		<option value="tzs">Tanzanian Shilling</option>


</select><br><br>
<span>Amount in Chosen Currency</span><br>
<input type="number" name="amount" min="<?=$general_details['minimum_deposit'] ?>" class="w3-padding"/>
<br>
<input type="submit" name="submit" class="w3-btn w3-indigo w3-margin" value="Next" />
<br>
<span class="w3-small">Please if your currency is not in the Dropdown choose US Dollar</span>
</div>