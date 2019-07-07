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

<a  href="<?=site_url('admin/publisher_profile_details/'.$space['user_id']) ?>" class="w3-btn w3-indigo w3-margin">View Publisher Details</a><br>


<a  href="http://<?=$space['website'] ?>" class="w3-btn w3-indigo w3-margin">Go to Publisher Website</a><br>

	<?php
foreach ($space as $key => $value) {
	if($key != 'code')
	{
echo "<tr>";
echo "<td>".$key."</td>";
echo "<td>".$value."</td>";
echo "</td>";
}
}
?>
	
	
</table>
</div>
<div class="w3-half  w3-center">
        <span class="w3-text-blue-gray w3-serif w3-xxlarge w3-margin">Look</span><br>
<?= $space['code'] ?>

</div>
<!--

--pending = paid need approval
--approved = paid and aproved =active
--disapproved = space disapproved = 
inactive






	--->
<div class="w3-container w3-margin">

<?php 

if($space['status'] == "active")
	{
echo '<a href="'.site_url("admin/space_action/pause/".$space['ref_id']).'" class="w3-btn w3-yellow">Stop</a>';

	}else{
echo '<a href="'.site_url("admin/space_action/start/".$space['ref_id']).'" class="w3-btn w3-green">Start</a>';

	}


?>


	</div>
</div>