<div class="w3-twothird">


<div class="w3-center">


<b class="w3-xlarge w3-text-blue-grey"><?php
$urlmsg = site_url("messages/send_pmessage/".$receiver_id);
$urlmail = site_url("messages/send_pmail/".$receiver_id);
switch(current_url())
{
case $urlmsg : $show = "Send User Personal Message:";
$btntext= "Send Message";
break;

case $urlmail : $show = "Send User Personal Mail:";
$btntext= "Send Email";
break;


default : $show = "Send User Personal Mail/Email:";
$btntext= "Send Email/Message";
break;


}
echo $show;

?></b><br>
<form action="<?php
echo site_url('messages/send_pmessage_act');
?>" method="post">
<span ="w3-text-red"><?php
echo validation_errors(); ?>
</span>
<?php
echo $err_reports;
?>
<br>
<span class="w3-label">Title:</span><br>

<span class="w3-text-blue-grey w3-large"><?php echo "to:".$receiver_name; ?></span><br>

<input type="hidden" name="id" value="<?php echo $receiver_id; ?>"></input>

<input type="text" class="w3-border-blue-grey" style="width:80%;height: 04%" name="title" value="<?php echo set_value('title'); ?>" placeholder="Message title"></input>
<br><br>




<center>
<span class="w3-label">Contents:</span><br>
<textarea placeholder="Mail or Message contents" class="w3-center w3-border-blue-grey" name="contents"  value="<?php  echo set_value('contents'); ?>" rows="15" cols="32"></textarea><br>


<br>

<input type='submit' class="w3-btn w3-blue" value="<?php echo $btntext;?>" ></form>








</div>
</div>