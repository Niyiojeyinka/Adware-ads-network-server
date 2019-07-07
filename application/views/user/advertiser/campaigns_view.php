<div class="w3-container w3-center">
<br>
<span class="w3-text-indigo w3-large w3-serif">Campaigns</span><br>

<?php
if(!empty($items))
{

foreach ($items as $item) {

echo "<a href='".site_url('advertiser_dashboard/view_details/'.$item['ref_id'])."'>";
echo "<div style='max-width:200px;height:150px;display:inline-block' class='w3-container w3-padding w3-margin w3-text-teal w3-border'>";
echo "<span class=''><b>".$item['name']."</b>
</span><hr>";
echo "<span class='w3-padding w3-border'><span class='w3-small'>".ucfirst($item['status'])."</span></span>";
echo "</div>";
echo "</a>";

}
}else{

	echo "No campaign available yet";
}
echo "<br>".$pagination;
?>
</div>