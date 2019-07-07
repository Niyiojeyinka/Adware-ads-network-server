<div class="w3-container w3-twothird">

	<br>
	<?php
if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}


	?>
<div class="w3-half">
<table class="w3-striped w3-small">

<a  href="<?=site_url('admin/advertiser_profile_details/'.$campaign['user_id']) ?>" class="w3-btn w3-indigo w3-margin">View Advertiser Details</a><br>

<a  href="http://<?=$campaign['dest_link'] ?>" class="w3-btn w3-indigo w3-margin">Go to Landing PAge</a><br>
	<?php
foreach ($campaign as $key => $value) {
echo "<tr>";
echo "<td>".$key."</td>";
echo "<td>".$value."</td>";
echo "</td>";
}
?>
	
	
</table>
</div>
<div class="w3-half  w3-center">
        <span class="w3-text-blue-gray w3-serif w3-xxlarge w3-margin">Look</span><br>

	<?php
if($campaign['type'] =="text")
{
  echo "<div class='w3-border w3-border-blue'>";
echo "<span class='w3-text-blue'><b>".$campaign['text_title']."</b></span><br>";
echo "<span class='w3-small'>".$campaign['text_content']."</span><br>";
echo "<span class='w3-text-blue'><b>".$campaign['disp_link']."</b></span><br>";

  echo "</div>";

}elseif ($campaign['type'] =="banner") {
   //echo "<div class='w3-container'><b>250px X 350px</b></div>";
    echo "<div class='w3-center'>";
echo "<img class='w3-card' style='max-width:100%;max-height:100%' src='".base_url('assets/campaigns/'.$campaign['img_link'])."'/>";
  echo "</div>";
}elseif ($campaign['type'] =="banner_text") {
  
    echo "<div style='max-width:300px;' class='w3-center w3-card'>";
echo "<img class='' style='max-width:100%;' src='".base_url('assets/campaigns/'.$campaign['img_link'])."'/>";
echo "<center><div style='width:200px;' class='w3-margin w3-center'>".$campaign['text_title']."</div>";
    echo "</center></div>";
}elseif ($campaign['type'] =="recommendation") {
  /*
    echo "<div style='max-width:300px;' class='w3-center w3-card'>";
echo "<img class='' style='max-width:100%;' src='".base_url('assets/campaigns/'.$campaign['img_link'])."'/>";
echo "<center><div style='width:200px;' class='w3-margin w3-center'>".$campaign['text_title']."</div>";
    echo "</center></div>";
*/


echo "<div class='w3-container w3-row w3-border w3-margin-bottom w3-padding w3-center' ><div class='w3-col s4 m12 w3-padding'><img class='w3-image w3-margin-top' src='".base_url('assets/campaigns/'.$campaign['img_link'])."'/></div><div id='text' class='w3-col s8 m12 w3-padding-bottom' style='text-align:justify;'><span class='w3-large' id='text'><b>".$campaign['text_title']."</b></span></div></div>";


}


	

		 ?>

</div>
<!--

--pending = paid need approval
--approved = paid and aproved =active
--disapproved = campaign disapproved = 
inactive






	--->
<div class="w3-container w3-margin">

<?php 
if($campaign['approval'] == "true")
{

if($campaign['status'] == "active")
	{
echo '<a href="'.site_url("admin/campaign_action/pause/".$campaign['ref_id']).'" class="w3-btn w3-yellow">Pause</a>';

	}else{
echo '<a href="'.site_url("admin/campaign_action/start/".$campaign['ref_id']).'" class="w3-btn w3-green">Start</a>';

	}

}
?>

<?php
if (strtolower($campaign['approval']) == "pending" || strtolower($campaign['approval']) == "false")
{

echo '<a href="'.site_url("admin/campaign_action/approve/".$campaign['ref_id']).'" class="w3-btn w3-green w3-margin">Approve</a>';


}


echo '<a href="'.site_url("admin/campaign_action/disapprove/".$campaign['ref_id']).'" class="w3-btn w3-red w3-margin">Disapprove</a>';

?>
	</div>
</div>