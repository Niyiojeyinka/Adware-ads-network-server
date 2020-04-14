 
 <div id="halfdiv" class="righthalf w3-half w3-padding-large">
<center>
 <div style="max-width: 80%;" class="w3-container w3-center">
            <div class="row">
              <div class="w3-col l6 info">
                <i class="fa fa-map w3-text-blue"></i>
                <p>Internet HQ, Kenya Nigeria Ghana South Africa Ughanda</p>
              </div>
              <div class="w3-col l6 info">
                <i class="fa fa-at w3-text-blue"></i>
                <p>support@custch.com</p>
              </div>
              <!--<div class="col-md-3 info">
                <i class="ion-ios-telephone-outline"></i>
                <p>+1 5589 55488 55</p>
              </div>-->
            </div>

            <div class="form">
              <span class="w3-small">Please note that you can also send us a message via our email ( <a class="w3-text-blue" href="mailto:support@custch.com"> support@custch.com</a> ) or via social media pages.</span>
<br>


<?php if(isset($_SESSION['action_status_report']))
 {

  echo $_SESSION['action_status_report'];

 }
  ?>
<span class="w3-text-pink"><?php echo validation_errors(); ?></span>
              <div id="errormessage"></div>
 <?php echo form_open('page/contact_us'); ?>
                <div class="w3-row">
                  <div class="w3-col l6 w3-padding">
                    <input type="text" name="name" class="form-control w3-padding w3-margin" id="name" placeholder="Your Name" />
                    <div class="validation"></div>
                  </div>
                  <div class="w3-col l6 w3-padding">
                    <input type="email" class="form-control w3-padding w3-margin" name="email" id="email" placeholder="Your Email"/>
                    <div class="validation"></div>
                  </div>
                </div>
                <div class="">
                  <input type="text" class="form-control w3-padding w3-margin" name="subject" id="subject" placeholder="Subject" />
                  <div class="validation"></div>
                </div>
                <div class="">
                  <textarea class="form-control w3-padding w3-margin" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit" class=" w3-btn w3-blue w3-margin w3-round-large" title="Send Message">Send Message</button></div>
              </form>
            </div>
          </div></center></div></section>