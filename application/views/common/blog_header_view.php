

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
          <li class="active"><a href="#intro">Home</a></li>
          <li><a href="<?php echo site_url("Login"); ?>">Login</a>
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
       <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" >
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                      <h2 class="subheading"><?=$item['title']?></h2>
                        <span class="meta w3-large">Posted by <a href="#">Custch</a> <?=date('F j,Y,g:ia',$item['time']) ?> </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
      </div>

    </div>
  </section>