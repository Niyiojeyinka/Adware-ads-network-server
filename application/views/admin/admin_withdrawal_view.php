<div class="w3-container w3-twothird w3-center"><br>
<span class="w3-text-blue-grey w3-xlarge">
Withdrawal Requests</span>

<div class="w3-container">
	<?php
if(!empty($items))
{
foreach ($items as $item) {
$user_details  = $this->user_model->get_user_by_its_id($item['user_id'],"publishers");


$wlink = site_url('admin/process_withdrawal/'.$item['id']).'/'.$user_details['id'];
$p_button = "<a class='w3-btn w3-blue w3-margin' href='".$wlink."'>Process</a>";
echo "<div class='w3-border w3-border-black'>";
echo $user_details['firstname']." ".$user_details['lastname']." <br> <span class='w3-small'>Amount:<del>N</del>".$item['amount']."</span>$p_button<br>";
echo '<a class="w3-small w3-btn w3-green" href="'.site_url("admin/login_to_user_account/publisher/".$user_details["id"]).'">Login to this  Account to check payment Details</a>';

echo "</div><br>";



}

echo $pagination;

}else{

echo "No Withdrawal Requests";



}
	




?>




<br><br>
</div>







</div>
