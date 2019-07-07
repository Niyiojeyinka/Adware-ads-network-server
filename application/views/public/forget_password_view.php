<div class='w3-container w3-center'>
<br><br><br><br>
<div class='w3-container  w3-card-4 w3-panel'>
  <div class="w3-container w3-center" style="">
 </div><br>
 <div>
   <form class='w3-center' method='POST' action='<?php echo site_url('page/forget_password'); ?>'>
<h4 class='w3-text-indigo w3-serif'><b>Forgotten Pasword</b></h4>
<div class='w3-text-red'><?php

echo validation_errors();
 if(isset($_SESSION['err_msg']))
{

  echo $_SESSION['err_msg'];

}
?></div><br>
<div class='w3-row'>
    <i  style='margin-right:3%' class="fa fa-email
     w3-large w3-text-indigo w3-center"></i>
     <input class='w3-center w3-padding w3-border' type='text' name='email'  value="<?php echo set_value("email"); ?>" placeholder='Email Address'/>
</div>

<div class='w3-row'><br>
    <span class="">Account Type</span><br>

     <select name="account_type" class="w3-center w3-padding w3-border">
       <option value="advertiser">Advertiser</option>
      <option value="publisher">Publisher</option>

     </select>
    
</div>
<br>
<center>
<div style="max-width: 60%" class="w3-container w3-center w3-text- w3-small w3-margin-bottom w3-margin-bottom">Password recovery link will be sent to your registered Email,Please check inbox or spam for the recovery mail.Thank you

   </div></center>

<input class='w3-center w3-btn w3-indigo w3-margin-top w3-margin-bottom' type='submit' name='submit' value='Send Me '/>



</div>
   </form>

<center>
   <div class="w3-text- w3-small w3-margin-bottom w3-margin-bottom">Don't have account yet? <span class="w3-text-indigo"><?php
echo "<a href='";
echo site_url('');
echo "'>Create Account Here</a>";

     ?></span>

<br>



   </div>
</center>
 </div>





</div>
<div>
