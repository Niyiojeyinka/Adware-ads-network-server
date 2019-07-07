<div class="w3-container w3-center">
<br>
<div class="w3-text-red w3-small"><?= validation_errors()."<br>".$error ?>

<?= form_open_multipart("advertiser_dashboard/add_campaign/".$this->uri->segment(3)) ?>
<div class="w3-container">
  <input type="hidden" name="cpa_name" value="<?php 
if(isset($campaign_name))
{
  echo $campaign_name;
}
  ?>">
  <div class="w3-third">
    
<span class="w3-serif w3-text-indigo w3-small">Campaign Name</span><br>
<?php if(!empty($this->uri->segment(3)))
{
echo "<span class='w3-gray w3-padding w3-text-white'>";
echo $campaign_name."--";
echo "</span>";
} ?>
<input type="text" value='<?php

echo set_value('campaign_name');
 ?>' name="campaign_name" class="w3-padding w3-border w3-border-blue w3-round w3-margin" placeholder="Campaign Name" required/>
<br><br>
 </div>
  <div class="w3-third">


<span class="w3-text-indigo w3-small">Campaign  Category(Your advertisement category):</span><br><br>

<select type="dropdown" name="category" class="w3-padding w3-border w3-border-blue w3-round" id="category">
<option value=null selected>Choose...</option>
<option value="agriculture">Agriculture</option>
<option value="advertising">Advertising</option>
<option value="banking">Banking & Finance</option>
<option value="computers">Computers & Internet</option>
<option value="e-commerce">E-commerce & Trading</option>
<option value="education">Education & Learning</option>
<option value="entertainment">Entertainment & Social</option>
<option value="food">Food & Nutrition </option>
<option value="gambling">Gambling & Betting</option>
<option value="motoring">Motoring</option>
<option value="marketing">Marketing & Affilate</option>
<option value="manufacturing">Manufacturing & Industry </option>
<option value="news">News & Media</option>
<option value="sport">Sport</option>
<option value="science">Science & Technology </option>
<option value="product">Products & Services</option>
<option value="politics">Politics</option>
<option value="others">Others</option>
</select>
</br>

  </div>


  <div class="w3-third">

<span class="w3-serif w3-text-indigo w3-small">Destination Link</span>
<br>
<input type="text" value='<?php
if(!empty($this->uri->segment(3)))
{
echo $campaign_dest;
}else{
echo set_value('destination_link');
}

  ?>' name="destination_link" class="w3-padding w3-border w3-border-blue w3-round w3-margin" placeholder="www.example.com/landing_page" required <?php
  if(!empty($this->uri->segment(3)))
{
echo 'readonly';
}?>/>
<br><br>


  </div>
  </div>

  </div>
  
  <span class="w3-text-indigo">Campaign Type</span><br>
<select name="campaign_type" onchange="typeContainer(this.value)" class="w3-padding w3-border-blue w3-margin">
  <option value="">Choose...</option>
  <option value="text">Create Text Only Campaign</option>
  <option value="banner">Create Banner Only Campaign</option>
  <option value="banner_text">Create Banner & Text Campaign</option>
</select>

<div id="text_only" class="w3-container w3-hide">
  <div class="w3-half">
<span class="w3-serif w3-text-indigo w3-small">Display Link</span>
<input type="text" name="display_link" class="w3-padding w3-border w3-border-blue w3-margin" value="<?= set_value("display_link") ?>" placeholder="www.example.com" />
<br>
</div> <div class="w3-half">
<span class="w3-serif w3-text-indigo w3-small">Campaign Title</span>
<input type="text" maxlength="100" name="campaign_title_text" class="w3-padding w3-border w3-border-blue w3-margin" value="<?= set_value("campaign_title_text") ?>" placeholder="Ex: Advertise with custch Advertising" />
<br>
</div>

  <span class="w3-serif w3-text-indigo w3-small">Campaign Text(Not > 160 characters)</span><br>
<textarea maxlength="160" cols="35" rows="10" name="campaign_content_text" class="w3-padding w3-border w3-border-blue"> <?php
if(!empty(set_value('campaign_content_text')))
{
echo set_value('campaign_content_text');

}else{
  echo "Contents of your Campaign here.";
}

?></textarea>

<br>


</div>







<div style="display: none" id="both_img" class="w3-container">
<div class="w3-half ">
<div id="banner_only" class="w3-hide">
   <br>
<span class="w3-serif w3-text-indigo w3-small">Campaign Size/Type</span><br>
<select name="campaign_size" class="w3-padding w3-border w3-border-blue">
    <option value="300X250">300 X 250 (Banner Only)</option>
    <option value="720X90"">468 X 60 (Recommended For Mobile Campaign)</option>

   <!-- <option value="720X90">720 X 90 (Banner Only)</option>
    <option value="160X600">160 X 600 (Banner Only)</option>-->
</select>  
</div>
<div id="banner_text" class="w3-hide">
   <span class="w3-serif w3-text-indigo w3-small">Campaign Text(Not > 140 characters)</span><br>
<textarea maxlength="140" cols="15" rows="5" name="campaign_title" class="w3-padding w3-border w3-border-blue"> <?php
if(!empty(set_value('campaign_title')))
{
echo set_value('campaign_title');

}else{
  echo "E.g Advertise your business online today with www.custch.com";
}

?></textarea>

<br>
</div>


</div>
<!--image here-->
<div class="w3-half">


  
<br>




<style type="text/css">
  div.use {
  padding:5px 10px;
  //background:#00ad2d;
  border:1px solid #00ad2d;
  position:relative;
  color:#fff;
  border-radius:2px;
  text-align:center;
  //float:right;
  cursor:pointer
}
.hide_file {
    position: absolute;
    z-index: 1000;
    opacity: 0;
    cursor: pointer;
    right: 0;
    top: 0;
    height: 100%;
    font-size: 24px;
    width: 100%;
    
}
</style>
<br>
<span class="w3-serif w3-text-indigo w3-small w3-margin">Upload Banner</span><br>

<div class="use w3-button w3-indigo w3-hover-white w3-hover-text-indigo"><i class="fa fa-file-image-o w3-jumbo"></i>
 <input type="file" name="banner" class="hide_file" />
</div>
 
</div>


</div>


<br>
<script>
function typeContainer(id) {
 var textDiv = document.getElementById("text_only");
 var bannerDiv = document.getElementById("banner_only");
 var bannerTextDiv = document.getElementById("banner_text");
 var bothImg = document.getElementById("both_img");
if(id == "text")
{
 textDiv.className += " w3-show";
  bannerDiv.className = bannerDiv.className.replace(" w3-show", "");
 bannerTextDiv.className = bannerTextDiv.className.replace(" w3-show", "");
 bothImg.className = " w3-hide";

}else if(id == "banner"){
 bannerDiv.className += " w3-show";
 textDiv.className = textDiv.className.replace(" w3-show", "");
 bannerTextDiv.className = bannerTextDiv.className.replace(" w3-show", "");
 bothImg.className += " w3-show";
}else if(id == "banner_text"){
bannerTextDiv.className += " w3-show";
 textDiv.className = textDiv.className.replace(" w3-show", "");
  bannerDiv.className =  bannerDiv.className.replace(" w3-show", "");
    bothImg.className += " w3-show";
}



}

</script>



<br>
 <input type="submit" name="submit" value="Next" class="w3-btn w3-indigo w3-large w3-round-xlarge w3-margin"/>
</form>

</div>
<br><!--
<div class="w3-container w3-center">
Need Help? Please read this page documentation <a class="w3-text-indigo" href="<?= site_url('blog/page-documentation-creating-new-campaign') ?>">HERE</a>

</div>-->
<br>