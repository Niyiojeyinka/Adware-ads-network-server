<!DOCTYPE html>
<html>
<title><?php echo $title; ?></title>
<meta charset="UTF-8">
<link rel="icon" href="<?php echo base_url('assets/media/images/favicon.png'); ?>" type="image/x-icon"/>
<link href="<?php echo base_url('assets/media/images/favicon.png'); ?>" rel="apple-touch-icon">

<meta name="description" content="<?php echo $description; ?>">
<meta name="keywords" content="<?php
echo $keywords;
?>">
<meta property="og:image" content="<?php

echo base_url('assets/media/images/faviconsocial.png');
?>
" />
<meta property="og:description" content="<?php echo $description; ?>" />
<meta property="og:url"content="<?php echo current_url(); ?>" />
<meta property="og:title" content="<?php echo $title; ?>" />
<meta name="author" content="<?php echo $author;?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"  href="<?php echo base_url('assets/css/fontawesome-4.6.3.min.css'); ?>"/>
<link rel="stylesheet"  href="<?php echo base_url('assets/css/w3.css'); ?>"/>
<script type="text/javascript" src='<?php echo base_url('assets/js/public.js'); ?>'></script>
<style>
a {
    text-decoration:none;
}
#menu-text {
  letter-spacing:0.2em;
}
@media screen and (min-width:400px){

#halfdiv {
height:inherit !important;
}
.lefthalf {
  float:left;
}
.righthalf {
  float:right;
}

}
</style>

<body class="">
<section class="">
    <header class="w3-row w3-bar w3-padding-xlarge w3-card">
  <a href="<?=site_url(); ?>"><img src="<?=base_url('assets/media/images/logo.png') ?>" class="w3-small" 
   style="max-width:100px;"
  /></a>

  <nav class="w3-right w3-small">
          <a href="<?=site_url() ?>"><span id="menu-text" class="w3-margin-left w3-button w3-padding w3-white
           w3-hover-blue w3-text-blue w3-hover-text-white w3-round-large">
              Home</span></a>
          <a href="<?=site_url("Login") ?>"><span id="menu-text" class="w3-margin-left w3-button w3-padding w3-white
           w3-hover-blue w3-text-blue w3-hover-text-white w3-round-large">
           Login</span></a>
           <a href="<?=site_url("Register") ?>"><span id="menu-text" class="w3-margin-left w3-button w3-padding w3-white
           w3-hover-blue w3-text-blue w3-hover-text-white w3-round-large">
           Register</span></a>    <a href="<?=site_url("Blog") ?>"><span id="menu-text" class="w3-margin-left w3-button w3-padding w3-white
           w3-hover-blue w3-text-blue w3-hover-text-white w3-round-large">
           Blog</span></a>    <a href="<?=site_url("contact_us") ?>"><span id="menu-text" class="w3-margin-left w3-button w3-padding w3-white
           w3-hover-blue w3-text-blue w3-hover-text-white w3-round-large">
           Contact Us</span></a>
           </nav><!-- .main-nav -->
</header>

</section>
