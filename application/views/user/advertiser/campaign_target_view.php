<div  class="w3-container w3-center">
    <span class="w3-text-indigo w3-xlarge w3-serif">Targeting Options</span><br>

    <a href="<?=site_url("advertiser_dashboard/skip_targeting/".$this->uri->segment(3)) ?>" class="w3-btn w3-indigo">Skip This</a><br>
    <div class="w3-small">By skipping your Campaign will be mark as GENERAL CAMPAIGN(Visible in all category)</div>

<?= form_open("advertiser_dashboard/campaign_target_action/".$this->uri->segment(3)) ?>
<div class="w3-container w3-center"> 
	     <i class="w3-text-green">Browser Targeting </i><br>      

<center>
<div style="width:60%" class="w3-container w3-card w3-padding-large w3-center">
    
 <input type="checkbox" class="w3-check" value="opera" name="browser[]"><span class="w3-label"> <i class="fa fa-opera w3-text-red"></i>Opera mini</span>
      <input type="checkbox" class="w3-check" value="chrome" name="browser[]"><span class="w3-label"> <i class="fa fa-chrome w3-text-yellow"></i>Google Chrome</span>

     <input type="checkbox" class="w3-check" value="firefox" name="browser[]"><span class="w3-label"> <i class="fa fa-firefox w3-text-blue"></i>Mozilla Firefox</span>

     <input type="checkbox" class="w3-check" value="sefari" name="browser[]"><span class="w3-label"> <i class="fa fa-safari w3-text-indigo"></i>Safari Browser</span>

    <input type="checkbox" class="w3-check" value="uc" name="browser[]"><span class="w3-label"> <i class="fa fa-uc-browser w3-text-blue"></i>UC Browser/Uc web</span> 

    <input type="checkbox" class="w3-check" value="ie" name="browser[]"><span class="w3-label"> <i class="fa fa-internet-explorer w3-text-blue"></i>Internet Explorer </span>


</div>
</center>


</div><!--browser div end here --->
     <br>     
  <div class="w3-container">
     
     <i class="w3-text-green">Platform Targeting </i><br>
     
<center>
<div style="width:60%" class="w3-container w3-card w3-padding-large w3-center">
<input type="checkbox" class="w3-check" value="desktop" name="platform[]"><span class="w3-label"> <i class="fa fa-desktop w3-text-blue-grey"></i>Desktop</span>
<input type="checkbox" class="w3-check" value="mobile" name="platform[]"><span class="w3-label"> <i class="fa fa-mobile w3-text-blue-grey"></i> Feature Phone</span> 
<input type="checkbox" class="w3-check" value="android" name="platform[]"><span class="w3-label"> <i class="fa fa-android w3-text-green"></i>Android Mobile</span>
 <input type="checkbox" class="w3-check" value="ios" name="platform[]"><span class="w3-label"> <i class="fa fa-apple w3-text-blue"></i>Ios(iphone,ipad) </span> 
 <input type="checkbox" class="w3-check" value="windows" name="platform[]"><span class="w3-label"> <i class="fa fa-windows w3-text-blue"></i>Windows Mobile</span> 
</div>

</center>
</div>
        
     
     <br>
  <!--   <div>
     <i class="w3-text-green">Category Targeting</i><br>
         
<center>
<div style="width:60%" class="w3-container w3-card w3-padding-large w3-center">
     <input type="checkbox" class="w3-check" value="advertising" name="tcategory[]"><span class="w3-label">Advertising</span>

 <input type="checkbox" class="w3-check" value="agriculture" name="tcategory[]"><span class="w3-label">Agriculture</span> 


 <input type="checkbox" class="w3-check" value="banking" name="tcategory[]"><span class="w3-label">Banking & Finance</span> 
<input type="checkbox" class="w3-check" value="Computers" name="tcategory[]"><span class="w3-label">Computers & Internet</span>

       <input type="checkbox" class="w3-check" value="e-commerce" name="tcategory[]"><span class="w3-label">E-commerce & Trading</span>
       <input type="checkbox" class="w3-check" value="education" name="tcategory[]"><span class="w3-label">Education & Learning</span> 
       <input type="checkbox" class="w3-check" value="entertainment" name="tcategory[]"><span class="w3-label">Entertainment & Social</span> 
<input type="checkbox" class="w3-check" value="food" name="tcategory[]"><span class="w3-label">Food & Nutrition</span>
<input type="checkbox" class="w3-check" value="gambling" name="tcategory[]"><span class="w3-label">Gambling & Betting</span>
 <input type="checkbox" class="w3-check" value="motoring" name="tcategory[]"><span class="w3-label">Motoring</span>
 <input type="checkbox" class="w3-check" value="marketing" name="tcategory[]"><span class="w3-label">Marketing & Affilate</span>

 <input type="checkbox" class="w3-check" value="manufacturing" name="tcategory[]"><span class="w3-label">Manufacturing & Industry</span>


 <input type="checkbox" class="w3-check" value="news" name="tcategory[]"><span class="w3-label">News & Media</span>


     <input type="checkbox" class="w3-check" value="sport" name="tcategory[]"><span class="w3-label">Sport</span>


     <input type="checkbox" class="w3-check" value="science" name="tcategory[]"><span class="w3-label">Science & Technology</span>

     <input type="checkbox" class="w3-check" value="product" name="tcategory[]"><span class="w3-label">Products & Services</span>
     <input type="checkbox" class="w3-check" value="politics" name="tcategory[]"><span class="w3-label">Politics</span>
     <input type="checkbox" class="w3-check" value="others" name="tcategory[]"><span class="w3-label">Others</span>

 
 



</div></center></div>-->

      


<style type="text/css">
    
#african-countries{

    width: 200px;
    height: 80%;

}

</style>
<br><br>
<center>
         <i class="w3-text-green">Country Targeting</i><br>

<div style="overflow:scroll;height:150px" class="w3-container w3-label w3-border w3-cente w3-card" id="african-countries">
<!--
<input type="checkbox" name="tcountry[]"  value="algeria">Algeria</input><br>
<input  type="checkbox" name="tcountry[]" value="angola">Angola</input><br>
<input  type="checkbox" name="tcountry[]" value="benin">Benin</input><br>
<input  type="checkbox" type="checkbox" name="tcountry[]" value="botswana">Botswana</input><br>
<input  type="checkbox" type="checkbox" name="tcountry[]" value="burkina Faso">Burkina Faso</input><br>
<input  type="checkbox" name="tcountry[]" value="burundi">Burundi</input><br>
 <input  type="checkbox" name="tcountry[]" value="cameroon">Cameroon</input><br>
<input  type="checkbox" name="tcountry[]" value="cape-verde">Cape Verde</input><br>
 <input  type="checkbox" name="tcountry[]" value="central-african-republic">Central African Republic</input><br>
  <input  type="checkbox" name="tcountry[]" value="chad">Chad</input><br>
  <input  type="checkbox" name="tcountry[]" value="comoros">Comoros</input><br>
 <input  type="checkbox" name="tcountry[]" value="congo-brazzaville">Congo - Brazzaville</input><br>
    <input  type="checkbox" name="tcountry[]" value="congo-kinshasa">Congo - Kinshasa</input><br> <input  type="checkbox" name="tcountry[]" value="ivory-coast">Côte d’Ivoire</input><br>
      <input  type="checkbox" name="tcountry[]" value="djibouti">Djibouti</input><br>
        <input  type="checkbox" name="tcountry[]" value="egypt">Egypt</input><br>
         <input  type="checkbox" name="tcountry[]" value="equatorial-guinea">Equatorial Guinea</input><br>
      <input  type="checkbox" name="tcountry[]" value="eritrea">Eritrea</input><br> <input  type="checkbox" name="tcountry[]" value="ethiopia">Ethiopia</input><br>
     <input  type="checkbox" name="tcountry[]" value="gabon">Gabon</input><br> <input  type="checkbox" name="tcountry[]" value="gambia">Gambia</input><br>-->
       <input  type="checkbox" name="tcountry[]" value="ghana">Ghana</input><br><!--
        <input  type="checkbox" name="tcountry[]" value="guinea">Guinea</input><br>
         <input  type="checkbox" name="tcountry[]" value="guinea-bissau">Guinea-Bissau</input><br>-->      <input  type="checkbox" name="tcountry[]" value="kenya">Kenya</input><br><!--
         <input  type="checkbox" name="tcountry[]" value="lesotho">Lesotho</input><br>
            <input  type="checkbox" name="tcountry[]" value="liberia">Liberia</input><br>
              <input  type="checkbox" name="tcountry[]" value="libya">Libya</input><br>
            <input  type="checkbox" name="tcountry[]" value="madagascar">Madagascar</input><br>
            <input  type="checkbox" name="tcountry[]" value="malawi">Malawi</input><br>      <input  type="checkbox" name="tcountry[]". value="mali">Mali</input><br>
            <input  type="checkbox" name="tcountry[]" value="mauritania">Mauritania</input><br>
              <input  type="checkbox" name="tcountry[]" value="mauritius">Mauritius</input><br>
              <input  type="checkbox" name="tcountry[]" value="mayotte">Mayotte</input><br>
              <input  type="checkbox" name="tcountry[]" value="morocco">Morocco</input><br>      <input  type="checkbox" name="tcountry[]" value="mozambique">Mozambique</input><br>
              <input  type="checkbox" name="tcountry[]" value="namibia">Namibia</input><br>
                 <input  type="checkbox" name="tcountry[]" value="niger">Niger</input><br>-->
                <input  type="checkbox" name="tcountry[]" value="nigeria">Nigeria</input><br>
                 <!-- <input  type="checkbox" name="tcountry[]" value="rwanda">Rwanda</input><br>
                 <input  type="checkbox" name="tcountry[]" value="reunion">Réunion</input><br>
                   <input  type="checkbox" name="tcountry[]" value="saint-helena">Saint Helena</input><br>
                    <input  type="checkbox" name="tcountry[]" value="senegal">Senegal</input><br>
                    <input  type="checkbox" name="tcountry[]" value="seychelles">Seychelles</input><br> 
                    <input  type="checkbox" name="tcountry[]" value="sierra-leone">Serra Leone</input><br>
                    <input  type="checkbox" name="tcountry[]" value="somalia">Somalia</input><br>-->
                     <input  type="checkbox" name="tcountry[]" value="south-africa">South Africa</input><br><!--
                     <input  type="checkbox" name="tcountry[]" value="sudan">Sudan</input><br>
                        <input  type="checkbox" name="tcountry[]" value="south-sudan">Sudan</input><br>
                       <input  type="checkbox" name="tcountry[]" value="swaziland">Swaziland</input><br> 
                     <input  type="checkbox" name="tcountry[]"  value="Sao-tome-príncipe">São Tomé and Príncipe</input><br>
                     <input  type="checkbox" name="tcountry[]" value="tanzania">Tanzania</input><br>
                          <input  type="checkbox" name="tcountry[]" value="togo">Togo</input><br> 
                          <input  type="checkbox" name="tcountry[]" value="tunisia">Tunisia</input><br>
                          <input  type="checkbox" name="tcountry[]" value="uganda">Uganda</input><br> <input  type="checkbox" name="tcountry[]" value="western-sahara">Western Sahara</input><br> <input  type="checkbox" name="tcountry[]" value="zambia">Zambia</input><br>
                            <input  type="checkbox" name="tcountry[]" value="zimbabwe">Zimbabwe</input><br>-->
</div>                          
                        
    
               </center>     
           
<input type="submit" name="submit" class="w3-btn w3-indigo w3-margin" value="Next"/>
           </form>         
                        
</div>

<br>
<!--<div class="w3-container w3-center">
Need Help? Please read this page documentation <a class="w3-text-indigo" href="<?= site_url('blog/page-documentation-campaign-targeting') ?>">HERE</a>

</div>-->
<br>