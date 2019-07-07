<div class="w3-container w3-center">
<br>
<span class="w3-text-indigo w3-large w3-serif">Form CPAs</span><br>
<div  style='display: inline;overflow-y: scroll' class="w3-container">

<?php
if(!empty($items))
{

foreach ($items as $item) {
//echo "<a href='".site_url('advertiser_dashboard/view_details/'.$item['ref_id'])."'>";
echo "<div style='max-width:200px;height:150px;display:inline-block' class='w3-container w3-padding w3-margin w3-text-teal w3-border'>";
echo "<span class=''><b>".$item['name']." <a href='".site_url('cpa_form/index/'.$item['form_slug'])."'><i class='fa fa-eye w3-text-green'></i></a></b>
</span><hr>";
echo "<a href='".site_url('advertiser_dashboard/edit_cpa_form/'.$item['ref_id'])."'><span class='w3-padding w3-border'><span class='w3-small fa fa-edit'></span></span></a>";

echo "<a href='".site_url('advertiser_dashboard/view_data_list/'.$item['ref_id'])."'><span class='w3-padding w3-border'><span class='w3-small'>Data<span class='w3-text-red'>(".count(json_decode($item['form_data'])).")</span></span></span></a>";

echo "</div>";
//echo "</a>";
}
}else{

	echo "No CPA available yet";
}
echo "<br>".$pagination;
?>
	



</div>

</div>