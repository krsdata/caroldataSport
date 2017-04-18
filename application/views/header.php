<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <title>Game</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="">

  <meta name="author" content="">
	

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>css/nyroModal.css" rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->

  <!--[if lt IE 9]>

    <script src="js/html5shiv.js"></script>

  <![endif]-->



  <!-- Fav and touch icons -->

  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>img/favicon.png">


	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>  

	<script type="text/javascript" src="<?php echo base_url(); ?>js/app.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/scripts.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.scrollTo.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>js/wow.min.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.nyroModal.custom.js"></script>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js">
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.validate.js"></script>
	
	<!--<div id="google_translate_element"></div>
	<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->

</head>

<!--  wow fadeInUp"  data-wow-duration="2s"-->

<body  ng-app="">

<!-- menu-->


<?php $id = $this->session->userdata('id'); if($id != '') { 
	  $balance = $this->session->userdata('balance');
	  $invested = $this->session->userdata('invested');
	  $gain_loss = $this->session->userdata('gain_loss');
?>
<div class="top-menu">
    <div class="container">
	<div class="pull-right">
    	<ul>
            <li><span>UP/DOWN</span> <a href="" class="btn btn-success btn-xs"><?php if($gain_loss != ''){ echo $this->sports->showBucks($gain_loss); }else{ echo '$ 0.00';} ?></a></li>
            <li><span>INVESTED</span> <a href="" class="btn btn-success btn-xs"><?php if($invested != ''){ echo $this->sports->showBucks($invested); }else{ echo '$ 0.00';} ?></a></li>
            <li><span>AVAILABLE</span> <a href="" class="btn btn-danger btn-xs"><?php if($balance != ''){ echo $this->sports->showBucks($balance); }else{ echo '$ 0.00';} ?></a></li>
            <li><a href="<?php echo base_url(); ?>funds" class="btn btn-danger btn-xs">FUNDS</a></li>
            <li class="input-top"><input class="form-control input-sm" placeholder="Search Markets" type="text"></li>
        </ul>
    </div>
    </div>
</div>
<?php } ?>
<nav class="navbar navbar-default menubar">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/logo1.png" class="img-responsive"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">                        
        <li class="dropdown">
        <a href="<?php echo base_url();?>browse/featured" class="dropdown-toggle" type="button" id="dropdownMenu1" aria-haspopup="true" aria-expanded="true">Markets</a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li class="nfl_dv"><a href="#">NBA</a>
			   <ul class="nfl_dv_inner">
			   <li><a href="<?php echo base_url(); ?>browse/propsMarket/NBA_Game_Props">NBA Game Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/NBA_Team_Props">NBA Team Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/NBA_Player_Props">NBA Player Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/NBA_Future_Props">NBA Future Props</a></li>
			  </ul>
		    </li>
            <li class="nfl_dv"><a href="#">NFL</a> <ul class="nfl_dv_inner">
			   <li><a href="<?php echo base_url(); ?>browse/propsMarket/NFL_Game_Props">NFL Game Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/NFL_Team_Props">NFL Team Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/NFL_Player_Props">NFL Player Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/NFL_Future_Props">NFL Future Props</a></li>
			  </ul></li>
            <li class="nfl_dv"><a href="#">MLB</a><ul class="nfl_dv_inner">
			   <li><a href="<?php echo base_url(); ?>browse/propsMarket/MLB_Game_Props">MLB Game Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/MLB_Team_Props">MLB Team Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/MLB_Player_Props">MLB Player Props</a></li>
				<li><a href="<?php echo base_url(); ?>browse/propsMarket/MLB_Future_Props">MLB Future Props</a></li>
			  </ul></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url(); ?>browse/featured">Other</a></li>
          </ul>
        </li>
        <li class="dropdown"> 
        <a href="<?php echo base_url(); ?>analysis" class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="true">Blog</a>
       
        </li>
        <li class="dropdown" ><a href="<?php echo base_url(); ?>about">About</a>
		    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a href="<?php echo base_url(); ?>sports-swaps">What is SportsSwaps?</a></li>
				<li><a href="<?php echo base_url(); ?>how-it-works">How it works</a></li>
				<li><a href="<?php echo base_url(); ?>faq">FAQ</a></li>
				<li><a href="#">Contact US</a></li>
            </ul>
		</li>
		<?php $id = $this->session->userdata('id'); if($id == '') {  ?>
       	<li><a href="<?php echo base_url(); ?>login">Sign In</a></li> 
        <li class="login-a"><a href="<?php echo base_url(); ?>signup">Sign Up</a></li>                         
		<?php }else{ $username = $this->session->userdata('username'); ?>
		<li class="login-a dropdown"><a class="dropdown-toggle" type="button"  aria-haspopup="true" aria-expanded="true" href="#"><?php echo $username ; ?></a>
		    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				<li><a href="<?php echo base_url(); ?>myshare"><i class="fa fa-share-square-o"></i> My Shares</a></li>
				<li><a href="<?php echo base_url(); ?>history"><i class="fa fa-history"></i> History</a></li>
				<li><a href="<?php echo base_url(); ?>funds"><i class="fa fa-usd"></i> Funds</a></li>
				<li><a href="<?php echo base_url(); ?>setting"><i class="fa fa-cog"></i> Settings</a></li>
				<li><a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out"></i> Sign Out</a></li>
            </ul>
		</li>
		
		<li class="login-a"><a href="<?php echo base_url(); ?>logout">Sign Out</a></li>
		<?php } ?>                         
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!--menu-->





