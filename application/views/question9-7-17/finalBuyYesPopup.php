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
<div class="modal-dialog">																												  <!-- Modal body-->														        
<div class="modal-content"><!--MODEL_HEADER---->																	
<div class="modal-header">																	  
<button type="button" class="close" data-dismiss="modal">×</button>																	  
<h4 class="modal-title">Buy Yes</h4>																	
</div>																	  																	
<div class="modal-body">																	  
<div id="showBuy">   																		
<div id="tradeBuyContent">																			
<div class="col-xs-12">																				
<div class="confirm-img float-left">																					
<a href="#">
				<?php if($optionDetail[0]['option_image']=='-') { ?>
					<img class=" img-responsive img-circle mb10" alt="Option Image" src="<?php echo base_url(); ?>img/no_bk.jpg">
					<?php }else{ ?>
					<img class=" img-responsive img-circle mb10" alt="Option Image" src="<?php echo $optionDetail[0]['option_image']; ?>">
					<?php } ?>
				</a>																			
</div>																				
<p class="confirm-question"><?php echo $optionDetail[0]['option_name']; ?></p>
</div>		                                                                   
<div class="col-xs-12"> <h3>Offer Processed </h3></div>																			
<div class="col-xs-12">																				
																			
</div>
<div class="col-xs-12">	
<form id="BuySubmit" method="POST" action >																		     
<div class="say_yes_new_j">

<?php if(isset($matched) && ($matched > 0) ) { ?>
<h3>Matched</h3>
<div class="col-xs-6">	
<p class="light_green_j"><span class="pull-left">Shares</span><span class="pull-right">Maximum Price/Share</span></p><br>
<p><span class="pull-left"><?php echo $matched ; ?></span><span class="pull-right"><?php echo $rate.'&cent;'; ?></span></p><br>
</div>

<div class="col-xs-6">	
<p class="light_green_j">Details</p><br>
<p><span class="pull-left">Risk Adjustment</span><span class="pull-right">(<?php echo $this->wallet->showBucks($riskAdj); ?>)</span></p><br>
</div>
<?php } ?>

<div class="col-xs-12">	
<?php if(isset($unmatched) && ($unmatched > 0) ) { ?>
<h3>Open Offer Recorded</h3>																				    
<p class="light_green_j"><span class="pull-left">Shares</span><span class="pull-right">Maximum Price/Share</span></p><br>
<p><span class="pull-left"><?php echo $unmatched ; ?></span><span class="pull-right"><?php echo $rate.'&cent;'; ?></span></p><br>

<?php } ?>
</div>

</div>
																			

								
<div class="col-xs-12 buttons_bottom">																			    
<div class="pull-left">																				    

<div class="float-right">																					

<button type="button" class="btn btn-success close" id="submitBuy" >Close</button>																			</div>																			
</div></form>
</div>																		
</div>																	
</div>																
</div>																													    
</div>														  														
</div>	

<script>
			$(document).ready(function(){
				
				$(".close").click(function(){
					$.nmTop().close();
					window.location.reload()
				});
				
				$("#submitBuy").click(function(){
					
					$.nmTop().close();
				window.location.reload()
					//$('#submitBuy').click(function (e) {
					
					
					
							/* $.ajax({
								type: "POST",
								url: "<?php echo base_url("market/confirm_deal"); ?>",
								data: $('#BuySubmit').serialize(),
								success: function (result) {
									//alert(result);
									//return false;
									if (result == 'confirm') {
										$.nmTop().close();
										//$('#myModal').modal('hide');
										//$('#myModal_third').modal('show');
										$.nmManual('<?php echo base_url("market/finalPopup/buy/yes"); ?>');
										//window.location.reload();
										return false;
									} 
								}
							});*/
					
				}); 
				
				///;//$('#BuySubmit').submit(function(e){
							
						//	e.preventDefault();
						//	return false;
						//});
						
			});
	</script>												  
