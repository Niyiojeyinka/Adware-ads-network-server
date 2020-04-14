<div id="halfdiv" class="righthalf w3-half w3-padding-jumbo">

  <div class="w3-margin-top">

    <form class='w3-center w3-margin-top' method='POST' action='<?php echo site_url('login'); ?>'>
 <h4 class='w3-text-blue'><b>Sign In</b></h4>

 <div class='w3-text-red'><?php echo validation_errors();
 if(isset($_SESSION['err_msg']))
 {

  echo $_SESSION['err_msg'];

 }
  ?></div>
<div><?php if(isset($_SESSION['action_status_report']))
 {

  echo $_SESSION['action_status_report'];

 }
  ?></div>


 <div class='w3-row'>
     <i  style='margin-right:3%' class="fa fa-at
      w3-large w3-text-blue w3-center"></i>
      <input class='w3-center w3-padding' type='email' name='email' placeholder='Email'/>
 </div>

 <br>

 <div class='w3-row'>
     <i  style='margin-right:3%' class="fa fa-unlock-alt
      w3-large w3-text-blue w3-center"></i>
      <input class='w3-center w3-padding' type='password' name='password' placeholder='Password'/>
 </div>


<span class="w3-text-blue w3-small">Account Type</span>
   <div class='w3-row'>
       <i  style='margin-right:3%' class="fa fa-dash
        w3-large w3-text-blue w3-center"></i>
  <select name="accounttype" class="w3-padding">
          <option value="Advertiser">Advertiser</option><option value="Publisher">Publisher</option>
        </select>
   </div><br>


 <input class='w3-center w3-btn w3-blue w3-margin-top w3-margin-bottom w3-hover-white w3-hover-text-blue w3-border w3-border-blue' type='submit' name='submit' value='Sign In'/>


</form>


 <center>
  <span><a class="w3-text-blue" href="<?=site_url('forget_password') ?>">Forget Password?</a> </span>
    <div class="w3-text- w3-small w3-margin-bottom w3-margin-bottom">Don't have account yet? <span class="w3-text-blue"><?php
 echo "<a href='";
 echo site_url('register');
 echo "'>Create New Account Here</a>";

      ?></span></div>
 </center>


</div></div>
</section>
