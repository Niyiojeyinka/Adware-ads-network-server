<div class="w3-container w3-center w3-twothird">
<br>
<div class="w3-container w3-serif">
<b class="w3-center w3-text-grey w3-xlarge">Upgrade Account</b><br>
</span>

<?= form_open('admin/upgrade_account/'.$this->uri->segment(3)) ?>
<div class="w3-text-red"><?php
$serr = NULL;
if(isset($_SESSION['err_msg']))
{
	$serr = $_SESSION['err_msg'];
}
$err = validation_errors()." ".$serr;


echo $err;

?>
</div>
<div class="w3-smallw3-padding w3-text-yellow">Please do not upgrade a user more than once,by doing so you are paying such user referral again and again</div>

<?php

echo '<br><input type="text" name="coupon" class="w3-padding w3-border" placeholder="Coupon Code" required/>'
;


?>


<br>

<input class='w3-center w3-btn w3-green w3-margin-top w3-margin-bottom' type='submit' name='submit' value='Upgrade Account'/>


   </div></div>