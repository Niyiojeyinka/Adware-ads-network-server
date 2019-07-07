
<div class="w3-container w3-padding-large w3-center">
<br>
<form action="<?php echo site_url("users/post_forg/".$this->uri->segment(3)); ?>" method="POST">


 <b class="w3-large w3-text-green">Change Password
</b><br>

<?php


echo '<div class="w3-text-red">'.validation_errors().'</div>';

if(isset($_SESSION['err_msg']))
{

  echo '<div class="w3-text-red">'.$_SESSION["err_msg"].'</div>';
  unset($_SESSION["err_msg"]);
}
?>


<div class='w3-row'>
    <i  style='margin-right:3%' class="fa fa-unlock-alt
     w3-large w3-text-green w3-center"></i>
     <input class='w3-center' type='password' name='npass'  value="<?php echo set_value("npass"); ?>" placeholder='New Password'/>
</div>



<br>

<div class='w3-row'>
    <i  style='margin-right:3%' class="fa fa-unlock-alt
     w3-large w3-text-green w3-center"></i>
     <input class='w3-center' type='password' name='cpass'  value="<?php echo set_value("cpass"); ?>" placeholder='Confirm Password'/>
</div>
<br>
<input type='submit' name='submit' value='Change Password' class='w3-button w3-green'/>




</form></div>