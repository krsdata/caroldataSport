<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <title>Game</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="">

  <meta name="author" content="">



	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->

	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->

	<!--script src="js/less-1.3.3.min.js"></script-->

	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

	

	<link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>css/font-awesome.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">

	<link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">



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

</head>

<!--  wow fadeInUp"  data-wow-duration="2s"-->

<body  ng-app="" >

<!-- menu-->


<?php $id = $this->session->userdata('id'); if($id != '') {  ?>
<div class="top-menu">
    <div class="container">
	<div class="pull-right">
    	<ul>
            <li><span>GAIN/LOSS</span> <a href="" class="btn btn-success btn-xs">$0.00</a></li>
            <li><span>INVESTED</span> <a href="" class="btn btn-success btn-xs">$0.00</a></li>
            <li><span>AVAILABLE</span> <a href="" class="btn btn-danger btn-xs">$9.90</a></li>
            <li><a href="" class="btn btn-danger btn-xs">DEPOSIT</a></li>
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

      <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>img/logo.png" class="img-responsive"></a>

    </div>



    <!-- Collect the nav links, forms, and other content for toggling -->

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">                        

        <li class="dropdown">

        <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Markets</a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <li><a href="#">Action</a></li>

            <li><a href="#">Another action</a></li>

            <li><a href="#">Something else here</a></li>

            <li role="separator" class="divider"></li>

            <li><a href="#">Separated link</a></li>

          </ul>

        </li>

        <li class="dropdown"> 

        <a href="#" class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Analysis</a>

        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

            <li><a href="#">Action</a></li>

            <li><a href="#">Another action</a></li>

            <li><a href="#">Something else here</a></li>

            <li role="separator" class="divider"></li>

            <li><a href="#">Separated link</a></li>

          </ul>

        </li>

        <li><a href="<?php echo base_url(); ?>about">About</a></li>
		<?php $id = $this->session->userdata('id'); if($id == '') {  ?>
       	<li><a href="<?php echo base_url(); ?>login">Sign In</a></li> 
        <li class="login-a"><a href="<?php echo base_url(); ?>signup">Sign Up</a></li>                         
		<?php }else{ ?>
		<li class="login-a"><a href="<?php echo base_url(); ?>logout">Sign Out</a></li>
		<?php } ?>
      </ul>

    </div><!-- /.navbar-collapse -->

  </div><!-- /.container-fluid -->

</nav>





<!--menu-->





