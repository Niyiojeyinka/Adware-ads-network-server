<div class="w3-twothird">


<div class="w3-center">

<b class="w3-center w3-text-grey w3-xlarge">Pending Pulishers</b><br>

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

 echo "<a href='".site_url('admin/pending_account_profile/'.$item['id'])."'>";
echo "<div class='w3-container w3-border w3-padding w3-margin'>";
echo $item['firstname']." ".$item['lastname']." <br>";
echo "<span class='w3-small'>Last Seen:";
echo " ".date( "F j, Y, g:i a",$item["lastlog"]);
echo "</span><br>";
echo "</div>";
echo "</a>";
}



echo $pagination;

}else{
echo "No Pending Publishers";

}


?>


</ul>
</div>
