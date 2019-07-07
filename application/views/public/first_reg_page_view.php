
  <div class="w3-padding-jumbo">

    <form class='w3-center' method='POST' action='<?php echo
    site_url('Register'); ?>'>
 <h4 class='w3-text-blue'><b>Registration</b></h4>

 <div class='w3-text-red w3-tiny'><?php echo validation_errors();
 if(isset($_SESSION['err_msg']))
 {

  echo $_SESSION['err_msg'];

 }
  ?></div>


<span class="w3-text-blue w3-small">Please choose your Account Type</span><br>
   
<button  class="w3-button w3-padding-large w3-round-jumbo w3-blue w3-margin w3-hover-white w3-hover-text-blue w3-border w3-border-blue"  name="accounttype" value="Advertiser">Register as An Advertiser</button><br>

<button  class="w3-button w3-padding-large w3-round-jumbo w3-blue w3-margin w3-hover-white w3-hover-text-blue w3-border w3-border-blue"  name="accounttype" value="Publisher">Register as A Publisher</button>


</form>
 </div>

    <center>
       <div class="w3-text- w3-small w3-margin-bottom w3-margin-bottom">Already have Account? <span class="w3-text-blue"><?php
    echo "<a href='";
    echo site_url('login');
    echo "'>Login Here</a>";

         ?></span></div>
    </center>


