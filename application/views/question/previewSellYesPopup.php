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
<div class="modal-header ">																	  
<button type="button" class="close" onclick="close_jbox()">×</button>																	  
<h4 class="modal-title">Sell Yes</h4>																	
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
<div class="col-xs-12"> <h3>Confirm Offer</h3></div>																			
<div class="col-xs-12">																				
<p class="text_para">if  your offer cannot be matched in full,an open offer will be recorded.Open offers in any contract that you are unable to cover as a result of this transaction will be cancled.</p>																			
</div><form id="BuySubmit" method="POST" action >	
<div class="col-xs-12">																			     
<div class="say_yes_new_j">																				    
<p class="light_green_j"><span class="pull-left">Shares</span><span class="pull-right"><?php echo $share_count; ?></span></p><br>
<p><span class="pull-left">Maximum Price/Share</span><span class="pull-right"><?php echo $rate.'&cent;'; ?></span></p><br>

   <div class="Confirm_Offer">

   <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#Market_Risk2"><p><span class="pull-left">Increase In Market Risk(details)</span><span class="pull-right"><?php echo $this->wallet->showBucks($req_bal)	; ?></span></p></a>
                </h4>
            </div>
            <div id="Market_Risk2" class="panel-collapse collapse">
                <div class="panel-body">
                
<p><span class="pull-left">Funds debited to cover your market risk after this trade</span><span class="pull-right"><?php echo $this->wallet->showBucks($req_bal)	; ?></span></p>
<p><span class="pull-left">Current Risk</span><span class="pull-right"><?php echo $this->wallet->showBucks($currentRisk)	; ?></span></p>
<p><span class="pull-left">Projected New Risk</span><span class="pull-right"><?php echo $this->wallet->showBucks($projectedRisk)	; ?></span></p>
                </div>
            </div>
        </div>
    
  
    </div>
	</div>




<br>


<p class="light_green_j"><span class="pull-left">Maximum Debit </span><span class="pull-right">(<?php echo $this->wallet->showBucks($req_bal)	; ?>)</span></p><br>
</div>																			
</div>
<input type="hidden" name="type" id="type" value="<?php echo $type; ?>" >
								<input type="hidden" name="deal_type" id="deal_type" value="sell" >
								<input type="hidden" name="option_id" id="option_id" value="<?php echo $option_id; ?>" >
								<input type="hidden" name="question_id" id="question_id" value="<?php echo $question_id; ?>" >
								<input type="hidden" name="PricePerShare" id="PricePerShare" value="<?php echo $rate; ?>" >
								<input type="hidden" name="Quantity" id="Quantity" value="<?php echo $share_count; ?>" >
<div class="col-xs-12 buttons_bottom">																			    
<div class="pull-left">																				    
<button type="button" class="btn btn-default" id="submitBack">Back</button></div>
<div class="float-right">																					
<button type="button" class="btn btn-default" id="cancelModal" onclick="close_jbox()" >Cancle</button>
<button type="button" class="btn btn-success" id="submitBuy" >Submit Offer</button>																			</div>																			
</div>		</form>																
</div>																	
</div>																
</div>																													    
</div>														  														
</div>	

<script>
			$(document).ready(function(){
				
				$("#submitBuy").click(function(){
					
					
					//$('#submitBuy').click(function (e) {
					
					
					//alert('fsd');
							$.ajax({
								type: "POST",
								url: "<?php echo base_url("market/confirm_deal"); ?>",
								data: $('#BuySubmit').serialize(),
								success: function (result) {
									//alert(result);
									//return false; 
									//alert(result);
									if (result == 'confirm') {
										$.nmTop().close();
										//$('#myModal').modal('hide');
										//$('#myModal_third').modal('show');
										$.nmManual('<?php echo base_url("market/finalSellPopup/"); ?>');
										//window.location.reload();
										return false;
									} 
								}
							});
					
				});
				
				$(".close").click(function(){
					$.nmTop().close();
					window.location.reload()
				});
				///;//$('#BuySubmit').submit(function(e){
							
						//	e.preventDefault();
						//	return false;
						//});
						
			});
	</script>												  
												  
