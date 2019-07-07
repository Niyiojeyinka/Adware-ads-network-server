<div class="w3-twothird w3-center">
	<div class="w3-container w3-small">
		
		<div class="w3-half">
			<div class="w3-container">
<span class="">Publishers : <span class="w3-text-green w3-xlarge"><?=$no_publishers ?></span></span>
<br>
<span class="">New Publishers in last 24hrs: <?=$num_of_publishers_24 ?></span><br>
<span class="">New Publishers in last 7days: <?=$num_of_publishers_7d ?></span><br>
<span class="">New Publishers in last 30days: <?=$num_of_publishers_30d ?></span><br>
<span class="">Publishers online in last 24hrs: <?=$num_of_publishers_online_24 ?></span><br>
<span class="">Publishers online in last 30days: <?=$num_of_publishers_online_30d ?></span><br>




			</div>

		</div>
  	
		<div class="w3-half">
			<div class="w3-container">
<span class="">Advertisers : <span class="w3-text-green w3-xlarge"><?=$no_advertisers ?></span></span>
<br>
<span class="">New Advertiser in last 24hrs: <?=$num_of_advertisers_24 ?></span><br>
<span class="">New Advertiser in last 7days: <?=$num_of_advertisers_7d ?></span><br>
<span class="">New Advertisers in last 30days: <?=$num_of_advertisers_30d ?></span><br>
<span class="">Advertisers online in last 24hrs: <?=$num_of_advertisers_online_24 ?></span><br>
<span class="">Advertisers online in last 30days: <?=$num_of_advertisers_online_24 ?></span><br>



			</div>

		</div>

  </div>


<div class="w3-container w3-small">
		
		<div class="w3-half">
			<div class="w3-container">
<span class="">Spaces : <span class="w3-text-blue w3-large"><?= $no_spaces ?></span></span>
<br>
<span class="">New Spaces in last 24hrs: <?= $num_of_spaces_24 ?></span><br>
<span class="">New Spaces in last 7days: <?= $num_of_spaces_7d ?></span><br>
<span class="">New Spaces in last 30days: <?= $num_of_spaces_30d ?></span><br>
<!--<span class="">Spaces Active in last 24hrs:</span><br>
<span class="">Spaces Active in last 30days:</span><br>-->




			</div>

		</div>
  	
		<div class="w3-half">
			<div class="w3-container">
<span class="">Campaigns : <span class="w3-text-blue w3-large"><?= $no_campaigns ?></span></span>
<br>
<span class="">New Campaigns in last 24hrs: <?= $num_of_campaigns_24 ?></span><br>
<span class="">New Campaigns in last 7days: <?= $num_of_campaigns_7d ?></span><br>
<span class="">New Campaigns in last 30days: <?= $num_of_campaigns_30d ?></span><br>



			</div>

		</div>

  </div>



<div class="w3-container w3-small">
		
		<div class="w3-half">
			<div class="w3-container">
<span class="">Views : <span class="w3-text-blue w3-large"><?= $num_total_views ?></span></span>
<br>
<span class="">New Views in last 24hrs: <?= $num_of_views_24 ?></span><br>
<span class="">New Views in last 7days: <?= $num_of_views_7d ?></span><br>
<span class="">New Views in last 30days: <?= $num_of_views_30d ?></span><br>





			</div>

		</div>
  	
		<div class="w3-half">
			<div class="w3-container">
<span class="">Clicks : <span class="w3-text-blue w3-large"><?= $num_total_clicks ?></span></span>
<br>
<span class="">New Clicks in last 24hrs: <?= $num_of_clicks_24 ?></span><br>
<span class="">New Clicks in last 7days: <?= $num_of_clicks_7d ?></span><br>
<span class="">New Clicks in last 30days: <?= $num_of_clicks_30d ?></span><br>



			</div>

		</div>

  </div>




<?php
if(!empty($pending_campaigns))
{

foreach ($pending_campaigns as $item) {
echo "<a href='".site_url('admin/view_campaign_details/'.$item['ref_id'])."'>";
echo "<div class='w3-container w3-padding w3-margin w3-text-teal'>";
echo "<span class='w3-padding w3-border'><b>".$item['name']."</b>
</span>";
echo "<span class='w3-padding w3-border'>".ucfirst($item['status'])."</span>";
echo "<span class='w3-padding w3-border'><span class='w3-small'>More info</span></span>";
echo "</div>";
echo "</a>";
}
}else{

	echo "No campaign available yet";
}
//echo $pagination;
?><br><br>

<!-- View accounting details by country form-->
<?= form_open('admin/view_accounting_details_by_country') ?>

<select name="country" class="w3-padding">

<?php
foreach ($countries as $country){
?>	
<option value="<?=$country['select_value'] ?>"><?=$country['name'] ?></option>
<?php
}
?>
</select>
<br>
<input type="submit" name="submit" class="w3-button w3-indigo w3-round-jumbo w3-margin" value="View"/>


  </form>

<!--ends here-->


<br>
<br>

</div>