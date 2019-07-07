<br><br><br>
<div class="w3-container w3-text-indigo w3-center w3-margin-top"><?php
echo validation_errors();
if(isset($_SESSION['err_msg']))
{
  echo $_SESSION['err_msg'];
} ?>

<div style="width:100%" class="w3-container">
<?php echo form_open("/ch_admin");

?>
        <center>
        	<span class="w3-text-indigo w3-large">ADmin Login</span><br>

<span class="w3-label">Username:</span>

<input  style="width:60%" class="w3-input" name="name" value="<?php echo set_value("name"); ?>" placeholder="Username" requiindigo></input>
<br>

<span class="w3-label">Password:</span>
<input style="width:60%" class="w3-input" type='password' name="pass" value="<?php echo set_value("pass"); ?>" placeholder="Password" requiindigo></input>
<br>

<input class="w3-btn w3-indigo" name="submit" type="submit" value="Login"></center>
</div></div>



