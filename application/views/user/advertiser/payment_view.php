<div class="w3-container w3-center">
<span class="w3-text-indigo w3-large w3-serif">Account Deposit</span><br>
<?php
if(isset($_SESSION['action_status_report']))
{

	echo $_SESSION['action_status_report']."<br>";
}

?>
<?= form_open('advertiser/payment') ?>
<br>
<span>Amount in </span><br>
<input type="number" name="amount" min="<?=$general_details['minimum_deposit'] ?>" class="w3-padding"/>
<br>
<input type="submit" name="submit" class="w3-btn w3-indigo w3-margin" value="Next" />
<br>

</div>