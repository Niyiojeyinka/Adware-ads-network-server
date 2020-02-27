<div class="w3-twothird w3-center w3-padding w3-center">

	<span class="w3-xlarge w3-text-blue-grey">
   Business Settings
	</span>
<div class="w3-padding w3-row">
<?= form_open("admin/site_settings") ?>

<?=isset($_SESSION['action_status_report'])?$_SESSION['action_status_report']:"" ?>
<br>
<div class="w3-container w3-half">
	
<span class="w3-label w3-large">Currency Code: </span><br>
<input type="text" placeholder="Currency Code e.g USD" class="w3-padding w3-margin" name="currency_code"
 value="<?=$settings['currency_code'] ?>"/>
<br>
<span class="w3-label w3-large">Minimum CPC: </span><br>
<input type="number" placeholder="Minimum CPC eg 0.98" class="w3-padding w3-margin" name="minimum_cpc"
 value="<?=$settings['minimum_cpc'] ?>"/>
<br>
<span class="w3-label w3-large">Minimum CPA: </span><br>
<input type="number" placeholder="Minimum CPA eg 5.78" class="w3-padding w3-margin" name="minimum_cpa"
 value="<?=$settings['minimum_cpa'] ?>"/>
<br>
<span class="w3-label w3-large">Minimum Paid CPA: </span><br>
<input type="number" placeholder="Minimum Paid CPA eg 50.00" class="w3-padding w3-margin" name="minimum_paid_cpa"
 value="<?=$settings['minimum_paid_cpa'] ?>"/>
<br>

</div>

<div class="w3-container w3-half">
	<span class="w3-label w3-large">Minimum CPM: </span><br>
<input type="number" placeholder="Minimum CPM eg 0.003" class="w3-padding w3-margin" name="minimum_cpm"
 value="<?=$settings['minimum_cpm'] ?>"/>
<br>
<span class="w3-label w3-large">Minimum Budget: </span><br>
<input type="number" placeholder="Minimum Budget eg 50000.00" class="w3-padding w3-margin" name="minimum_budget"
 value="<?=$settings['minimum_budget'] ?>"/>
<br>

<span class="w3-label w3-large">Minimum Deposit: </span><br>
<input type="number" placeholder="Minimum Deposit eg 50000.00" class="w3-padding w3-margin" name="minimum_deposit"
 value="<?=$settings['minimum_deposit'] ?>"/>
<br><span class="w3-label w3-large">Minimum Withdrawal: </span><br>
<input type="number" placeholder="Minimum Withdrawal eg 50000.00" class="w3-padding w3-margin" name="minimum_payout"
 value="<?=$settings['minimum_payout'] ?>"/>
<br>

</div>

<br>

<input type="submit" class="w3-button w3-blue w3-margin w3-padding" name="submit" value="Update Settings"/>

</div>




</div>
