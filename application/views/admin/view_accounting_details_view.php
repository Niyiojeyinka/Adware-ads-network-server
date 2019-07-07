<div class="w3-twothird w3-center">
	<br>
	<span class="w3-text-blue w3-large w3-serif"><?=$country_details['name'] ?></span>
	<br>

<?="<img style='max-width:20%;' class='w3-margin' src='".base_url('assets/media/images/'.$country_details['flag_slug'])."'/>" ?>
<div>
	<span class="w3-text-blue">Publishers' Pending Balance :</span> <?=$country_details['currency_code'] ?><?=$pending_earning ?><br>
	<span class="w3-text-blue">Publishers' Balance Now :</span> <?=$country_details['currency_code'] ?><?=$bal_earning ?><br>
	<span class="w3-text-blue">Advertisers' Balance Now :</span> <?=$country_details['currency_code'] ?><?=$adv_bal_earning ?><br>

</div>

</div>