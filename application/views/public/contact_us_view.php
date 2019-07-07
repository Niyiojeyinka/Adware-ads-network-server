 <center>
 <div style="max-width: 80%;" class="w3-container w3-center">
            <div class="row">
              <div class="col-md-6 info">
                <i class="ion-ios-location-outline"></i>
                <p>Internet HQ, Kenya Nigeria Ghana South Africa Ughanda</p>
              </div>
              <div class="col-md-6 info">
                <i class="ion-ios-email-outline"></i>
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
                <div class="form-row">
                  <div class="form-group col-lg-6">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validation"></div>
                  </div>
                  <div class="form-group col-lg-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validation"></div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit" class=" w3-btn w3-blue w3-margin w3-round-large" title="Send Message">Send Message</button></div>
              </form>
            </div>
          </div></center>