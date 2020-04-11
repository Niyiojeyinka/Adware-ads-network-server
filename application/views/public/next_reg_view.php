<div id="halfdiv" class="righthalf w3-half w3-padding-jumbo">

  <div class="">

    <form class='w3-center' method='POST' action='<?php echo
    site_url('next_reg'); ?>'>
 <h4 class='w3-text-blue'><b>Registration</b></h4>

 <div class='w3-text-red w3-tiny'><?php echo validation_errors();
 if(isset($_SESSION['err_msg']))
 {

  echo $_SESSION['err_msg'];

 }
  ?></div>

   <div class='w3-row'>
       <i  style='margin-right:3%' class="fa fa-globe
        w3-large w3-text-blue w3-center"></i>
        <input class='w3-center w3-padding' type='text' name='website'
        value='<?= set_value('website') ?>' placeholder='Your Website URL'/>
   </div>
<br>


<span class="w3-small w3-text-blue">Account Country</span>
<br>
<!--List of african countries-->
<select type="text" class="w3-padding" name="country" id="african-countries"> 
 <option selected>Choose</option> <option value="algeria">Algeria</option> <option value="angola">Angola</option> <option value="benin">Benin</option> <option value="botswana">Botswana</option> <option value="burkina Faso">Burkina Faso</option> <option value="burundi">Burundi</option> <option value="cameroon">Cameroon</option> <option value="cape-verde">Cape Verde</option> <option value="central-african-republic">Central African Republic</option> <option value="chad">Chad</option> <option value="comoros">Comoros</option> <option value="congo-brazzaville">Congo - Brazzaville</option> <option value="congo-kinshasa">Congo - Kinshasa</option> <option value="ivory-coast">Côte d’Ivoire</option> <option value="djibouti">Djibouti</option> <option value="egypt">Egypt</option> <option value="equatorial-guinea">Equatorial Guinea</option> <option value="eritrea">Eritrea</option> <option value="ethiopia">Ethiopia</option> <option value="gabon">Gabon</option> <option value="gambia">Gambia</option><option value="ghana">Ghana</option><option value="guinea">Guinea</option> <option value="guinea-bissau">Guinea-Bissau</option> <option value="kenya">Kenya</option> <option value="lesotho">Lesotho</option> <option value="liberia">Liberia</option> <option value="libya">Libya</option> <option value="madagascar">Madagascar</option> <option value="malawi">Malawi</option> <option value="mali">Mali</option> <option value="mauritania">Mauritania</option> <option value="mauritius">Mauritius</option> <option value="mayotte">Mayotte</option> <option value="morocco">Morocco</option> <option value="mozambique">Mozambique</option> <option value="namibia">Namibia</option> <option value="niger">Niger</option> <option value="nigeria">Nigeria</option><option value="rwanda">Rwanda</option>  <option value="reunion">Réunion</option> <option value="saint-helena">Saint Helena</option> <option value="senegal">Senegal</option> <option value="seychelles">Seychelles</option> <option value="sierra-leone">Sierra Leone</option> <option value="somalia">Somalia</option> <option value="south-africa">South Africa</option> <option value="sudan">Sudan</option> <option value="south-sudan">Sudan</option> <option value="swaziland">Swaziland</option> <option value="Sao-tome-príncipe">São Tomé and Príncipe</option> <option value="tanzania">Tanzania</option> <option value="togo">Togo</option> <option value="tunisia">Tunisia</option>--> <option value="uganda">Uganda</option><option value="western-sahara">Western Sahara</option> <option value="zambia">Zambia</option> <option value="zimbabwe">Zimbabwe</option> </select>
<br>



<span class="w3-small w3-text-blue">Terms & Conditions</span>
<br>
 <textarea cols="30" rows="10">By Clicking the Register button you  agree to our terms and Condition as stated below


<?=$terms ?>
 </textarea><br>
 <!-- <?= var_dump($_SESSION['first_details']) ?>-->
  <input class='w3-center w3-btn w3-blue w3-margin-top w3-margin-bottom w3-hover-white w3-hover-text-blue w3-border w3-border-blue'
  type='submit' name='submit' value='Register'/>
 


</form>
<div class="w3-text-red w3-center">* All Fields Are Required</div>
 </div>

    <center>
       <div class="w3-text- w3-small w3-margin-bottom w3-margin-bottom">Already have Account? <span class="w3-text-blue"><?php
    echo "<a href='";
    echo site_url('login');
    echo "'>Login Here</a>";

         ?></span></div>
    </center>
</div></section>

 