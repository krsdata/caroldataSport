<!-- banner-->
<div class="banner">
	<div class="container">
    	<div class="row">
        <div class="col-sm-6">
    	<h3><?php if($homeData->slider_title != '') { echo $homeData->slider_title; } ?></h3>
        <p><?php if($homeData->slider_content != '') { echo $homeData->slider_content; } ?></p>
        <div class="button-baner">
        	<a href="" class="btn btn-success btn-lg">FREE SIGN UP</a>
        	<a href="" class="btn btn-default btn-lg">HOW IT WORKS</a>
        </div>
        </div>
        </div>
    </div>
</div>
<!-- banner-->
<!-- Predictions-->
<div class="Predictions">
	<div class="container">    	
    	<h3 class="heading"><?php if($homeData->middle_title != '') { echo $homeData->middle_title; } ?></h3>
        <p class="para"><?php if($homeData->middle_content != '') { echo $homeData->middle_content; } ?></p>
        
        <div class="text-center">
		<?php if($homeData->youtube_url != '') { ?>
		<!--<iframe class="video-iframe" src="<?php //echo $homeData->youtube_url; ?>" width="511px;" height="287px;" frameborder="0" allowfullscreen=""></iframe>-->
		<img class="img-responsive" src="<?php echo base_url(); ?>img/video.png" style="display:inline-block">
		<?php }else{ ?>
        	<img class="img-responsive" src="<?php echo base_url(); ?>img/video.png" style="display:inline-block">
			<?php } ?>
        </div>        
    </div>
</div>
<!-- Predictions-->
<!--feature-->
<div class="feature">
	<div class="container">
    	<h3 class="heading">~ How It Works ~</h3>
        <p class="sub-head">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
    	<div class="row boxes">
		
        		<div class="col-sm-4">  
                	<h2><span>B</span>rowse <span>M</span>arkets</h2>
                    <p><img src="<?php echo base_url(); ?>img/1.png"></p>
                    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</p>
                </div>
        		<div class="col-sm-4">
                	<h2><span>M</span>ake a  <span>P</span>rediction</h2>
                    <p><img src="<?php echo base_url(); ?>img/2.png"></p>
                    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</p>
                </div>
        		<div class="col-sm-4">
                	<h2><span>T</span>rade  <span>Y</span>our <span>S</span>hares</h2>
                    <p><img src="<?php echo base_url(); ?>img/3.png"></p>
                    <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</p>
                </div>
                
        </div>
    </div>
</div>
<!--feature-->
<!-- Team img
<div class="team-img">
	<img src="<?php echo base_url(); ?>img/team.png" class="img-responsive">
</div>-->
<!-- Team img-->
<!--slider-->
<!----<div class="slider margintop15">
	<div class="container">    
    	<h1 class="heading"><?php if($homeData->logos_title != '') { echo $homeData->logos_title; } ?></h1>
        
        <div class='row'>
    <div class='col-md-12'>
      <div class="carousel slide media-carousel" id="media">
        <div class="carousel-inner">
          <div class="item  active">
            <div class="row">          
              <?php foreach($logo as $lg){ ?>
			  	<div class="col-sm-2">
                <a class="thumbnail" href="#"><img alt="" src="<?php echo IMG_LOGO.$lg->image; ?>"></a>
              </div>
              <?php } ?>      
            </div>
          </div>
          <div class="item">
            <div class="row">
              <?php foreach($logo as $lg){ ?>
			  	<div class="col-sm-2">
                <a class="thumbnail" href="#"><img alt="" src="<?php echo IMG_LOGO.$lg->image; ?>"></a>
              </div>
              <?php } ?>        
            </div>
          </div>          
        </div>
        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media" class="right carousel-control">›</a>
      </div>                          
    </div>
  </div>
        
    </div>
</div>--->
<!--slider-->
<!--upper-->
<div class="upper">
	<div class="container">
    	<h1 class="heading">~ ARE YOU READY TO START WINNING? ~</h1>
        <p class="margintop15">Sign up and enjoy <span class="uppercase">Sports Swaps</span> for free.</p>
        <br>
        <p><a href="" class="btn btn-success btn-lg">FREE SIGN UP</a></p>
    </div>
</div>
<!--upper-->