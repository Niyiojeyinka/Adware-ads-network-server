

  <!--==========================
  Header
  ============================-->
  <header id="header" class="fixed-top">
    <div class="container">

      <div class="logo float-left">
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <h1 class="text-light"><a href="#header"><span>NewBiz</span></a></h1> -->
        <a href="#intro" class="scrollto"><img src="<?=base_url("assets/media/images/logo.png") ?>" alt="" class="img-fluid"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?=site_url() ?>">Home</a></li>
          <li><a href="<?php echo site_url("Login#login"); ?>">Login</a>
          </li>
          <li><a href="<?php echo site_url("Register"); ?>">Register</a></li>
          <li><a href="<?php echo site_url("Blog"); ?>">Blog</a></li>

          <li><a href="<?php echo site_url("advertisers"); ?>">Advertisers</a></li>
          <li><a href="<?php echo site_url("publishers"); ?>">Publishers</a></li>
          <li><a href="<?php echo site_url("How_it_Works") ; ?>">How It Works</a></li>
          <li class="drop-down"><a href="">Ad Formats</a>
            <ul>
              <li><a href="#">Native Recomendation</a></li>
             
              </li>
              <li><a href="#">Banner</a></li>
              <li><a href="#">Text</a></li>
              <li><a href="#">Keyword</a></li>
            </ul>
          </li>
          <li><a href="<?php echo site_url("contact_us") ; ?>">Contact Us</a></li>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- #header -->

  <!--==========================
    Intro Section
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container">

      <div class="intro-img">
        <img src="<?=base_url("assets/media/images/intro-img.svg") ?>" alt="" class="img-fluid">
      </div>

      <div class="intro-info">
        <h2>Delivering  Future Online Advertising <br><span>solutions</span><br>for 
      Africa Today!</h2>
        <div>
          <a href="<?= site_url('publishers')?>" class="btn-get-started scrollto">Publisher</a>
          <a href="<?= site_url('advertisers')?>" class="btn-services scrollto">Advertiser</a>
        </div>
      </div>

    </div>
  </section><!-- #intro -->
