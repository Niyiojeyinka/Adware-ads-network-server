
<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-blue w3-card w3-left-align w3-large">
    <a id="to_hide_large" class="w3-bar-item w3-button w3-right w3-padding-large w3-hover-white w3-large w3-blue w3-text-white" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu">Menu<i class="fa fa-bars"></i></a>
    <a href="<?php echo site_url(); ?>" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a id="to_hide_small" href="<?php echo site_url("Register"); ?>" class="w3-bar-item w3-button to-hide-small w3-padding-large w3-hover-white">Register</a>

    <a id="to_hide_small" href="<?php echo site_url("Login"); ?>" class="w3-bar-item w3-button to-hide-small w3-padding-large w3-hover-white">Login</a>


    <a id="to_hide_small" href="<?php echo site_url("How_it_Works"); ?>" class="w3-bar-item w3-button to-hide-small w3-padding-large w3-hover-white">How it Works</a>
   <!-- <a id="to_hide_small" href="<?php echo site_url("Disclaimer"); ?>" class="w3-bar-item w3-button to-hide-small w3-padding-large w3-hover-white">Disclaimer</a>-->
     <a id="to_hide_small" href="<?php echo site_url("Blog"); ?>" class="w3-bar-item w3-button to-hide-small w3-padding-large w3-hover-white">Our Blog</a>
     <a id="to_hide_small" href="<?php echo site_url("advertisers"); ?>" class="w3-bar-item w3-button to-hide-small w3-padding-large w3-hover-white">Advertisers</a>
      <a id="to_hide_small" href="<?php echo site_url("publishers"); ?>" class="w3-bar-item w3-button to-hide-small w3-padding-large w3-hover-white">Publishers</a>

    <a id="to_hide_small" href="<?php echo site_url("contact_us") ; ?>" class="w3-bar-item w3-button to-hide-small w3-padding-large w3-hover-white">Contact Us</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
     <a href="<?php echo site_url("Register"); ?>" class="w3-bar-item w3-button w3-padding-large w3-hover-blue w3-hover-text-white">Register</a>

    <a href="<?php echo site_url("Login"); ?>" class="w3-bar-item w3-button w3-padding-large w3-padding-large w3-hover-blue w3-hover-text-white">Login</a>


     <a href="<?php echo site_url("How_it_Works") ; ?>" class="w3-bar-item w3-button w3-padding-large w3-padding-large w3-hover-blue w3-hover-text-white">How it Works</a>

       <a  href="<?php echo site_url("advertisers"); ?>" class="w3-bar-item w3-button w3-padding-large w3-padding-large w3-hover-blue w3-hover-text-white">Advertisers</a>
      <a  href="<?php echo site_url("publishers"); ?>" class="w3-bar-item w3-button w3-padding-large">Publishers</a>

         <!-- <a href="<?php echo site_url("Disclaimer") ; ?>" class="w3-bar-item w3-button w3-padding-large">Disclaimer</a>-->
    <a href="<?php echo site_url("Blog"); ?>" class="w3-bar-item w3-button w3-padding-large">Our Blog</a>
    <a href="<?php echo site_url("contact_us") ; ?>" class="w3-bar-item w3-button w3-padding-large w3-padding-large w3-hover-blue w3-hover-text-white">Contact Us</a>
  </div>
</div>



<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
<noscript>Pls turn on JavaScript!</noscript>
