<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<title><?php echo $title; ?></title>
<meta charset="UTF-8">
<link rel="icon" href="<?php echo base_url('assets/media/images/favicon.png'); ?>" type="image/x-icon"/>

<meta name="description" content="">
<meta name="keywords" content="<?php
//echo $keywords;
?>">


<meta property="og:image" content="<?php

echo base_url('assets/media/images/pricetagfav.ico');



?>
" />

<meta property="og:description" content="<?php //echo $description; ?>" />

<meta property="og:url"content="<?php //echo current_url(); ?>" />

<meta property="og:title" content="<?php //echo $title; ?>" />


<meta name="author" content="<?php //echo $author;?>">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"  href="<?php echo base_url('assets/cj/fontawesome-4.6.3.min.css'); ?>"/>

<link rel="stylesheet"  href="<?php echo base_url('assets/cj/w3mobile.css'); ?>"/>


<link rel="stylesheet"  href="<?php echo base_url('assets/cj/w3.css'); ?>"/>

<!--<link rel="stylesheet"  href="<?php echo base_url('assets/cj/w3mobile.css'); ?>">-->


		<!---editor dependency plus jquery-->
  <link rel="stylesheet"  href="<?php echo base_url('assets/bootstrap3.3.5/css/bootstrap.css'); ?>">
  <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>">
		</script>
  <script type="text/javascript" src="<?php echo base_url('assets/bootstrap3.3.5/js/bootstrap.js'); ?>">
		</script>
<link rel="stylesheet"  href="<?php echo base_url('assets/dist/summernote.css'); ?>">
<script type="text/javascript" src="<?php echo base_url('assets/dist/summernote.js'); ?>">

</script>

<style>
a {
  text-decoration: none !important;
}

@media screen and (min-width:400px){
#menuc {
width:50%;
}
#imgmedia {
display:inline-block;
width:40%;
height:50%;
}
}



@media screen and (max-width:400px){



}







a {
text-decoration:none;
}

body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<div style="height:2%;width:100%;padding:1%;" class="w3-bar w3-black w3-text-white">
<div style="height:auto;width:20%;padding:;display:inline" class="w3-bar w3-black w3-text-white">
</div>


<span class="w3-large w3-padding"><b>
Admin Dashboard</b><br><br>
</span>

</div>


<div class=""><!--container div-->
