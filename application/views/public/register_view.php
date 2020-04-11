<div id="halfdiv" class="righthalf w3-half w3-padding-jumbo">

<div id="reg" class="w3-padding-jumbo w3-center">

    <form class='w3-center' method='POST' action='<?php echo
    site_url('page/first_next'); ?>'>
 <h4 class='w3-text-blue'><b>Registration</b></h4>

 <div class='w3-text-red w3-tiny'><?php echo validation_errors();
 if(isset($_SESSION['err_msg']))
 {

  echo $_SESSION['err_msg'];

 }
  ?></div>

<div class="w3-row">
   <div class='w3-half'>
       <i  style='margin-right:3%' class="fa fa-user
        w3-large w3-text-blue w3-center"></i>
        <input class='w3-center w3-padding' type='text' name='firstname'
        value='<?= set_value('firstname') ?>' placeholder='First Name'/>
   </div>


   <div class='w3-half'>
       <i  style='margin-right:3%' class="fa fa-user
        w3-large w3-text-blue w3-center"></i>
        <input class='w3-center w3-padding' type='text' name='lastname'
          value='<?= set_value('lastname') ?>'  placeholder='Last Name'/>
   </div>
</div>
   <br>


 <br>

<div class="w3-row">
 <div class='w3-half'>
     <i  style='margin-right:3%' class="fa fa-envelope
      w3-large w3-text-blue w3-center"></i>
      <input class='w3-center w3-padding' type='email' name='email'
        value='<?= set_value('email') ?>'  placeholder='Email Address'/>
 </div>


 <div class='w3-half'>
     <i  style='margin-right:3%' class="fa fa-phone
      w3-large w3-text-blue w3-center"></i>
      <input class='w3-center w3-padding' type='tel' name='phone'
       value='<?= set_value('phone') ?>' placeholder='Phone Number'/>
 </div>
</div>
 <br>
<div class="w3-row">
 <div class='w3-half'>
     <i  style='margin-right:3%' class="fa fa-unlock-alt
      w3-large w3-text-blue w3-center"></i>
      <input id="password_box" class='w3-center w3-padding' type='password' name='password'
        value='<?= set_value('password') ?>'  placeholder='Password'/>
 </div>


 <div class='w3-half'>
     <i  style='margin-right:3%' class="fa fa-unlock-alt
      w3-large w3-text-blue w3-center"></i>
      <input id="password_box" class='w3-center w3-padding' type='password' name='cpassword'
        value='<?= set_value('cpassword') ?>' placeholder='Confirm Password'/>
 </div></div>
<!--<input type="checkbox" id="show_p" name="show_pass" value="checked" class=""/>Show Password<br>
--><script type="text/javascript">

$('document').ready(function(){
var type = $('#password_box').attr('type');
$('#show_p').change(function(){
if (type == "password")
{

  $('#password_box').attr('type','text');

}
else
{

  $('#password_box').attr('type','password');

}
//alert('reed');

}
);

});

</script>



  
  <input class='w3-center w3-btn w3-blue w3-margin-top w3-margin-bottom w3-hover-white w3-hover-text-blue w3-border w3-border-blue'
  type='submit' name='submit' value='Next'/>
 


</form> </div>
<div class="w3-text-red w3-center">* All Fields Are Required<br>
Already have Account? <span class="w3-text-blue"><?php
    echo "<a href='";
    echo site_url('login');
    echo "'>Login Here</a>";

         ?></span></div></div></section>