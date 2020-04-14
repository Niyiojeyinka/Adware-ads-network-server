<br><div class="w3-margin-top">

<br>

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter"><a href="<?= site_url("advertiser_dashboard/Campaign") ?>">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-file-text w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?= $count_campaigns ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Campaigns</h4>
      </div></a>
    </div>
    <div class="w3-quarter"><a href="<?= site_url("advertiser_dashboard/cpa_forms_list") ?>">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-caret-right w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3><?=$count_cpa ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Forms</h4>
      </div></a>

      <!--<a href="<?= site_url("advertiser_dashboard/Affilate") ?>">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-user-plus w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>1</h3>
        </div>
        ''
        <div class="w3-clear"></div>
        <h4>Affilate</h4>
      </div></a>-->
    </div>
    <div class="w3-quarter"><a href="<?= site_url("advertiser/payment") ?>">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-money w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>1</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Payments</h4>
      </div></a>
    </div>
    <div class="w3-quarter"><a href="<?= site_url('advertiser_dashboard/settings') ?>">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-gears w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>2</h3>
        </div>
        <div class="w3-clear"></div>
        <h5>Settings</h5>
      </div></a>
    </div>
  </div>


</div>
<div class="w3-center">
  
<span class="w3-large w3-serif"><a class="w3-btn w3-white w3-large w3-serif w3-text-indigo " href="<?= site_url("advertiser_dashboard/choose_campaign_type") ?>">Start New Campaign</a></span><br>
<span class="w3-large w3-serif"><a class="w3-btn w3-white w3-large w3-serif w3-text-indigo" href="<?= site_url("advertiser_dashboard/cpa_form") ?>">Create Form</a></span></div>


