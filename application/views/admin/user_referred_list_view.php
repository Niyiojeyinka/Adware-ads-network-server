<div class="w3-twothird w3-center">
	<br>
<i class="w3-xlarge w3-text-blue-grey">Users' Referred Details</i><br>
<div>
	Total Users Referred : <?= $total_users_referred ?><br>
	Total Premium Users Referred : <?= $total_premium_users_referred ?><br>
Total Users Referred since Last Withdrawal : <?= $no_of_users_referred_since_w ?><br>
    <span class="w3-text-green">GREEN</span> <span class="w3-small">represent paid users</span>

<br><br>
<b class="w3-text-blue-grey">Users Referred Since Last Withdrawal</b><br>
</div>
<?php
if (!empty($users_referred_since_w))
{



foreach ($users_referred_since_w as $item)
{

if($item['paid_status'] == "true")
{
$color = "class='w3-text-green'";

}else{

$color = "";


}
 
echo "<div class='w3-container w3-border w3-padding w3-margin'>";
 echo "<a ".$color." href='".site_url('admin/user_profile/'.$item['id'])."'>";
echo $item['firstname']." ".$item['lastname']." ".$item['username']."<br>";
echo "</a>";
echo "<span class='w3-small'>Last Seen:";
echo " ".date( "F j, Y, g:i a",$item["lastlog"]);
echo "</span><br>";
echo "<div class='w3-text-blue'>  <a href='".site_url('admin/email/'.$item['id'])."'>Email</a>   <a href='".site_url('admin/suspend/'.$item['id'])."'>Suspend User</a></div>";
if(empty($color))
{

echo "   <a class='w3-small w3-btn w3-green' href='".site_url('admin/upgrade_account/'.$item['id'])."'>Upgrade User</a>";


}
echo "</div>";
}



//echo $pagination;

}


if(empty($last_withdrawal_time)){
echo "User has no Withdrawal records";

}
if (empty($users_referred_since_w) && (!empty($last_withdrawal_time)))
{
echo "User refused to refer after previous withdrawals";
}


?>














</div>