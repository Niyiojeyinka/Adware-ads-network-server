<div class="w3-container w3-center">
	
	<b class="w3-serif w3-large w3-text-indigo">Choose Campaign Type</b><br>

<div class="w3-container w3-margin"><br>
	<span class="w3-btn w3-white w3-border"><i class="fa fa-eye w3-text-red"></i> <span class="w3-small">View Demo</span></span><br>

<div class="w3-third">
<a href="<?=site_url('advertiser_dashboard/add_recommendation/'.$this->uri->segment(3)) ?>">	<div class="w3-container w3-padding-xlarge w3-card w3-margin">
         <i class="fa fa-align-center w3-text-red w3-jumbo"></i>	<br>
         <span class="w3-large">Native Recommendation</span><br>
        <span class="w3-small"> Best for Article/Story Promotion</span>
	</div></a>

</div>

<div class="w3-third">
	<a href="<?=site_url('advertiser_dashboard/add_text_campaign/'.$this->uri->segment(3)) ?>">	<div class="w3-container w3-padding-xlarge w3-card w3-margin">
         <i class="fa fa-font w3-text-green w3-jumbo"></i>	<br>
         <span class="w3-large">Text Only Campaign</span><br>
        <span class="w3-small">To Promote Your Products/Services in Text Only Format</span>
	</div></a>

</div>

<div class="w3-third">
	<a href="<?=site_url('advertiser_dashboard/add_banner_campaign/'.$this->uri->segment(3)) ?>">	
	<div class="w3-container w3-padding-xlarge w3-card w3-margin">
         <i class="fa fa-image w3-text-blue w3-jumbo"></i>	<br>
         <span class="w3-large">Banner Campaign</span><br>
        <span class="w3-small">To Promote Your Products/Services With Banner</span>
	</div></a>

</div>

</div>

</div>