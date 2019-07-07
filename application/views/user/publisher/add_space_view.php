<div class="w3-container w3-center">
<br>
<span class="w3-text-indigo w3-xlarge w3-serif">Add Space</span><br>

<?= form_open("publisher_dashboard/add_space") ?>


<div class=""><center>
  <div class="" style="max-width: 80%">
  In our last update you are now required to copy and paste the code below to the head section(inbetween the < head> tag) of your website for performance purpose(<span class="w3-text-red">Please note you are to do this once per website</span>).<br><br>

<textarea readonly><?='
<link rel="stylesheet"  href="'.base_url('assets/cj/w3.css').'"/>
<script src="'.base_url('assets/js/jquery.js').'"></script> '?></textarea>

  <br><br>After which you can create a space below and copy and paste the generated code to anywhere you want to display our adverts.</div><br>

  
</center>
</div>
	
  <div class="w3-container">
<?php
if(isset($_SESSION['action_status_report']))
{
echo $_SESSION['action_status_report'];
}
?>
    <div class="w3-half">
<span class="w3-serif w3-text-indigo w3-small">Space Name</span>
<input type="text" value='<?= set_value('space_name') ?>' name="space_name" class="w3-padding w3-border w3-border-indigo w3-margin" placeholder="Space Name" required/>
<br><br>
</div>
<div class="w3-half">
<span class="w3-serif w3-text-indigo w3-small">Website URL</span>
<input type="text" name="website_url" class="w3-padding w3-border w3-border-indigo w3-margin" value="<?= set_value("website_url") ?>" placeholder="www.example.com" required/>
<br>
</div>
</div>


<center>
  <div class="w3-container">
	<span class="w3-text-indigo w3-small">Ads Space  Category(Display Advert from):</span>

<div class="w3-card w3-border w3-border-indigo w3-center" style="max-width: 200px;height:150px;overflow: scroll;">  <span class="">
  <span class="">
  <input type="checkbox" class="w3-check" value="agriculture" name="category[]"><span class="w3-text-grey">Agriculture</span> </span>
<br>
  <div class="w3-hide">

  <input type="checkbox" class="w3-check" value="advertising" name="category[]" checked><span class="w3-text-grey">Advertising</span> </span>
</div>
<br>
  <span class="">
   <input type="checkbox" class="w3-check" value="banking" name="category[]"><span class="w3-text-grey">Banking & Finance</span> </span>

<br>


<span class="">
  <input type="checkbox" class="w3-check" value="Computers" name="category[]"><span class="w3-text-grey">Computers & Internet</span></span>
<br>
<span class="">
  <input type="checkbox" class="w3-check" value="e-commerce" name="category[]"><span class="w3-text-grey">E-commerce & Trading</span>  </span>

<br>
   <span class="">
  <input type="checkbox" class="w3-check" value="education" name="category[]"><span class="w3-text-grey">Education & Learning</span>  </span>
<br>
    

<br>
   <span class="">
  <input type="checkbox" class="w3-check" value="entertainment" name="category[]"><span class="w3-text-grey">Entertainment(Gaming & Music included)</span>  </span>
<br>

   <span class="">
  <input type="checkbox" class="w3-check" value="food" name="category[]"><span class="w3-text-grey">Food & Nutrition</span>  </span>
<br>

<div class="w3-hide"><span>
  <input type="checkbox" class="w3-check" value="gambling" name="category[]" checked><span class="w3-text-grey">Gambling & Betting</span>  </span>
<br>
    </div>
 <span class="">
  <input type="checkbox" class="w3-check" value="motoring" name="category[]"><span class="w3-text-grey">Motoring</span> </span>
<br>
<div class="w3-hide">
<span>
  <input type="checkbox" class="w3-check" value="marketing" name="category[]" checked><span class="w3-text-grey">Marketing & Affilate</span> </span>
<br>
</div>
<span class="">
  <input type="checkbox" class="w3-check" value="manufacturing" name="category[]"><span class="w3-text-grey">Manufacturing & Industry </span> </span>
<br>


     <span class="">
  <input type="checkbox" class="w3-check" value="news" name="category[]"><span class="w3-text-grey">News & Media</span>  </span>
<br>

<span class="">
  <input type="checkbox" class="w3-check" value="sport" name="category[]"><span class="w3-text-grey">Sport</span>  </span>


<br>

 <span class="">
  <input type="checkbox" class="w3-check" value="other" name="category[]"><span class="w3-text-grey">Other</span>  </span>


<br>
    
     
</div></div>
<br>
  <span class="w3-text-indigo w3-small w3-margin">Ads Space Type:</span>
<br>
<select id="select_btn" onchange="showDiv()" name="type" class="w3-padding w3-border w3-border-indigo w3-margin">
      <option value="text">Text Campaigns</option>
      <option value="recommendation">Native Recommendation</option>
    <option value="banner">Banner Campaigns</option>
  
</select>
<br>
<div id="rec_div" style="display: none;" class="">
  <span class="w3-text-indigo w3-small w3-margin">Number Of Recommendation:</span><br>
  <select name="no_post" class="w3-padding w3-border w3-border-indigo">>
  <?php
for ($i=1; $i < 6; $i++) { 
?>
<option value="<?=$i ?>"><?=$i ?></option>
<?php }

  ?></select>
</div>
<br>
<div id="target_div" style="display: none;" class="">
  <span class="w3-text-indigo w3-small w3-margin">Ads Space Size:</span>
<br>
<select name="size" class="w3-padding w3-border w3-border-indigo">
    <!--<option value="250X250">250 X 250</option>-->
    <option value="300X250">300 X 250 </option>
    <option value="468X60">468 X 60 (Banner Only Size)</option>
   <!-- <option value="720X90">720 X 90 (Banner Only Size)</option>
    <option value="160X600">160 X 600 (Banner Only Size)</option>-->
   <!-- <option value="160X600">120 X 600 (Banner Only Size)</option>-->

</select>
</div>
<script type="text/javascript">
  function showDiv() {
   var select_btn = document.getElementById('select_btn').value;
  var target_div = document.getElementById('target_div');
  var rec_div = document.getElementById('rec_div');
  if (select_btn == "banner"){
 target_div.className += " w3-show";
 //hide rec_div
    rec_div.className = rec_div.className.replace(" w3-show", "");

  }else if(select_btn == "recommendation"){
 rec_div.className += " w3-show";
    //hide prev
    target_div.className = target_div.className.replace(" w3-show", "");
  }
}

 
  
 
</script>
</center><br>


 <input type="submit" name="submit" value="Generate Code" class="w3-btn w3-indigo"/>
</form>
<br>
  <span class="w3-text-indigo w3-small">Integration Code</span>
<br>
<textarea id="secretInfo" class="w3-padding w3-margin  w3-border w3-border-indigo">
  
<?php
if(!empty($code))
{
  echo $code;
}else{

  echo "Click Generate Code Above to Integrate Custch ADs";
}


?>

</textarea>
<input type="button" id="btnCopy" class="w3-btn w3-small w3-indigo w3-round-jumbo" name="copy" value="Copy Code"/>
  
    <script type="text/javascript">
      var $body = document.getElementsByTagName('body')[0];
      var $btnCopy = document.getElementById('btnCopy');
      var secretInfo = document.getElementById('secretInfo').value;
      var copyToClipboard = function(secretInfo) {
        var $tempInput = document.createElement('INPUT');
        $body.appendChild($tempInput);
        $tempInput.setAttribute('value', secretInfo)
        $tempInput.select();
        document.execCommand('copy');
        $body.removeChild($tempInput);
      }
      $btnCopy.addEventListener('click', function(ev) {
        copyToClipboard(secretInfo);
              alert('copied');

      });

    </script>

</div>

<br><!--
<div class="w3-container w3-center">
Need Help? Please read this page documentation <a class="w3-text-indigo" href="<?= site_url('How_it_Works#space') ?>">HERE</a>

</div>-->
<br>