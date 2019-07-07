<div class="w3-twothird">


<div class="w3-center">

<b class="w3-center w3-text-grey w3-xlarge">Publishers</b><br>

<div class="w3-text-red"><?php
if(isset($_SESSION['err_msg']))
{
	echo 
 $_SESSION['err_msg'];
}



?>
</div>
<br>
<?= form_open('admin/search_users') ?>

<input type="Search" name="search" placeholder="Search Users" class="w3-padding w3-border" />

<select name="user_type" class="w3-padding">
	<option value="advertisers">Advertiser</option>
	<option value="publishers">Publisher</option>
</select>
<select name="type" class="w3-padding">
	<option value="email">By Email</option>
	<option value="firstname">Firstname</option>
	<option value="Lastname">Lastname</option>
</select>
<input type="submit" name="submit" value="Search" class="w3-btn w3-blue"><br>

</form>

</form>
<?php

if (!empty($items))
{



foreach ($items as $item)
{

 
echo "<div class='w3-container w3-border w3-padding w3-margin'>";
 echo "<a href='".site_url('admin/publisher_profile_details/'.$item['id'])."'>";
echo $item['firstname']." ".$item['lastname']." <br>";
echo "</a>";
echo "<span class='w3-small'>Last Seen:";
echo " ".date( "F j, Y, g:i a",$item["lastlog"]);
echo "</span><br>";

echo "<div class='w3-text-blue'><a href='".site_url('admin/send_msg/publisher/'.$item['id'])."'>Send A Message</a>    <a href='".site_url('admin/email/publishers/'.$item['id'])."'>Email</a> ";
if($item['account_status'] =="active")
{
echo "  <a href='".site_url('admin/suspend/publishers/'.$item['id'])."'>Suspend User</a></div>";
}else{
	echo '<a href="'.site_url("admin/resume/publishers/".$item['id']).'" class="w3-btn w3-tiny w3-round-large w3-green">Resume</a></div>
';

}
echo "   <a class='w3-small w3-btn w3-green' href='".site_url('admin/login_to_user_account/publisher/'.$item['id'])."'>Login to User Account</a>";

echo "</div>";
}



echo $pagination;

}else{
echo "No user entries";

}


?>


</ul>
</div>
