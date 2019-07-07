<div class="w3-container w3-center">
<br><br>
  <b class="w3-serif w3-large w3-text-indigo">Create New Text Campaign</b><br>

<br>
<div class="w3-text-red w3-small"><?= validation_errors()."<br>" ?>

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
  
  
  <input type="hidden" name="campaign_type" value="text" />

<div id="text_only" class="w3-container">
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


<br>
 <input type="submit" name="submit" value="Next" class="w3-btn w3-indigo w3-large w3-round-xlarge w3-margin"/>
</form>

</div>
<br><!--
<div class="w3-container w3-center">
Need Help? Please read this page documentation <a class="w3-text-indigo" href="<?= site_url('blog/page-documentation-creating-new-campaign') ?>">HERE</a>

</div>-->
<br>