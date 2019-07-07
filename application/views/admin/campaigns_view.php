<div class="w3-twothird"><br>
<span class="w3-serif w3-margin w3-text-indigo w3-large">Campaigns</span>

<div>
<br>



<?php
if(!empty($campaigns))
{

foreach ($campaigns as $item) {
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
echo $pagination;
?>




</div>
</div>