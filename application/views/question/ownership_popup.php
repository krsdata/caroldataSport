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

<div class="modal-dialog">
														
		  <!-- Modal body-->
				<div class="modal-content">
					<!--MODEL_HEADER---->
					<div class="modal-header">
					  <button type="button" class="close" onclick="close_jbox()">×</button>
					  <h4 class="modal-title">Ownership</h4>
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
							
							<?php   if(isset($shares) && !empty($shares)){ ?>
							<div class="col-md-12">
								 <div aria-multiselectable="true" role="tablist" id="accordion2" class="panel-group">
										<div class="panel panel-default">
											<div id="headingHoldings" role="tab" class="panel-heading sharesSell" data-toggle="collapse" data-target="#mySellLongShares1" style="cursor: pointer;">
												<p class="panel-title">
													<span>Your Shares:</span><b class="label alert-success label-lg"><?php echo $total_shares->shares; ?></b>
													<a aria-controls="mySellLongShares1" aria-expanded="false" href="#mySellLongShares12" data-parent="#accordion2" data-toggle="collapse" class="float-right collapsed">&nbsp; </a>
												</p>
											</div>

											<div aria-labelledby="mySellLongShares1" role="tabpanel" class="panel-collapse" id="mySellLongShares1">
												<div class="">
													<table class="table table-striped">
														<thead>
															<tr class="contract-header">
																<th class="showPointer">Type</th>
																<th class="showPointer hidden-xs">Date/Time (ET)</th>
																<th class="text-center">Shares <a href="#" data-toggle="tooltip" title="" data-original-title="Shares are sold in the order purchased"><i class="fa fa-question" aria-hidden="true"></i></a></th>
																<th class="text-right">Price</th>
															</tr>
														</thead>
														<tbody>
														<?php foreach($shares as  $shr) {  ?>
															<tr>
																<td><b class="label alert-success label-lg"><?php echo $shr->type; ?></b></td>
																<td class="hidden-xs"><?php echo date("d/m/Y h:i",strtotime($shr->created_date)); ?></td>
																<td class="text-center"><span class="off-center-center"><b class="label alert-success label-lg"><?php echo $shr->shares; ?></b></span></td>
																<td class="text-right"><?php echo $shr->rate; ?><span style="font-family: helvetica;">¢</span></td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>

									</div>
							</div>
							<?php } ?>
							
							<?php if(!empty($buy_offers) || !empty($sell_offers) ) { ?>
							<div class="col-md-12">
								 <div aria-multiselectable="true" role="tablist" id="accordion3" class="panel-group">
										<div class="panel panel-default">
											<div id="headingHoldings" role="tab" class="panel-heading sharesSell" data-toggle="collapse" data-target="#mySellLongShares2" style="cursor: pointer;">
												<p class="panel-title">
													<span>Your offers:</span> 
													<?php 
													if($total_buy_offer)
													{
														echo "Buy ".ucfirst($total_buy_offer->type)." <b class='label alert-success label-lg'>".$total_buy_offer->shares."</b> "; 
													}
													//print_r($total_sell_offer); die;
													if($total_sell_offer)
													{
														echo "Sell ".ucfirst($total_sell_offer->type)." <b class='label alert-success label-lg'>".$total_sell_offer->shares."</b> ";
													}	
													?>
													
													<!-- <b class="label alert-success label-lg">1</b> -->
													<a aria-controls="mySellLongShares2" aria-expanded="false" href="#mySellLongShares12" data-parent="#accordion3" data-toggle="collapse" class="float-right collapsed">&nbsp; </a>
												</p>
											</div>

											<div aria-labelledby="mySellLongShares2" role="tabpanel" class="panel-collapse in" id="mySellLongShares2">
												<div class="">
													<table class="table table-striped">
														<thead>
															<tr class="contract-header">
																<th class="showPointer">Type</th>
																<th class="showPointer hidden-xs">Date/Time (ET)</th>
																<th class="text-center">Shares <a href="#" data-toggle="tooltip" title="" data-original-title="Shares are sold in the order purchased"><i class="fa fa-question" aria-hidden="true"></i></a></th>
																<th class="text-right">Price</th>
																<th class="text-right"></th>
															</tr>
														</thead>
														<tbody>
														<?php  foreach($buy_offers as $boffer) { ?>
															<tr>

																<td><b class="label alert-success label-lg"><?php echo $boffer->type; ?></b></td>
																<td class="hidden-xs"><?php echo date("d/m/Y h:i",strtotime($boffer->created_date)); ?></td>
																<td class="text-center"><span class="off-center-center"><b class="label alert-success label-lg"><?php echo $boffer->unmatched_shares; ?></b></span></td>
																<td class="text-right"><?php echo $boffer->rate; ?><span style="font-family: helvetica;">¢</span></td>
																<td>cancel</td>
															</tr>
														<?php } //print_r($sell_offers); die; ?>
														<?php  foreach($sell_offers as $soffer) { ?>
															<tr>

																<td><b class="label alert-success label-lg"><?php echo $soffer->type; ?></b></td>
																<td class="hidden-xs"><?php echo date("d/m/Y h:i",strtotime($soffer->created_date)); ?></td>
																<td class="text-center"><span class="off-center-center"><b class="label alert-offers-green label-lg"><?php echo $soffer->unmatched_shares; ?></b></span></td>
																<td class="text-right"><?php echo $soffer->rate; ?><span style="font-family: helvetica;">¢</span></td>
																<td>cancel<	/td>
															</tr>
														<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>

									</div>
							</div>
							<?php } ?>

							

							<div class="col-xs-12 buttons_bottom">
								<div class="float-right">
									<button type="button" class="btn btn-default" data-dismiss="modal" id="cancelModal" data-target="#yes_long">Cancel</button>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			
			</div>
		  
		</div>