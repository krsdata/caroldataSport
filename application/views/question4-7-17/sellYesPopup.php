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



<!---<div class="modal fade" id="myModal" role="dialog">Buy yes model--->
<div class="modal-dialog">
<?php //echo "<pre>"; print_r($offers); ?>
<!-- Modal body-->
<div class="modal-content">
<!--MODEL_HEADER---->
<div class="modal-header">
  <button type="button" class="close" onclick="close_jbox()" data-dismiss="modal">×</button>
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


		<div class="col-xs-12">
			<p class="text_para">Click on an Offer or enter your preference below. If you don't see a price you like, enter a lower one.</p>
		</div>
		<div class="col-xs-12 col-sm-5">
			<div class="panel panel-success">
				<div class="panel-heading text-center">
					<h4 class="panel-title">Best Available Offers  <a href="#" data-toggle="tooltip" title="" data-original-title="Your open Offers are in green."><i class="fa fa-question" aria-hidden="true"></i></a></h4>
				</div>
				<div class="offers">
				<?php   if(empty($offers)){ echo "There are no available offers."; } else { ?>
					<table class="table table-condensed table-info table-hover ">
						<thead>
						<tr>
							<th>Shares</th>
							<th>Price</th>
						</tr>
						</thead>
						<tbody>
						<?php $k=1; $shrs = 0;  foreach($offers as $off) {
									$shrs = $shrs + $off->shares;
						?>	
							<tr>
								<td><input  type="hidden" name="shr<?php echo $k; ?>" id="shr<?php echo $k; ?>" value="<?php echo $shrs; ?>"  ><a href="#" style="width: 100%; display: block"  class="contractOffer"  title="168" id="shareid-<?php echo $k; ?>"><?php echo $off->shares; ?></a></td>
								<td><input  type="hidden" name="rat<?php echo $k; ?>" id="rat<?php echo $k; ?>" value="<?php echo $off->rate; ?>" ><a href="#" style="width: 100%; display: block"  class="contractOffer"  title="168" id="rateid-<?php echo $k; ?>"><?php echo $off->rate; ?><span style="font-family: helvetica;">¢</span></a></td>
							</tr>			
						<?php $k++; } ?>
						</tbody>
					</table>
				<?php } ?>
				</div>
			</div>
		</div>


		<div class="col-xs-12 col-sm-7">
			<form action="<?php base_url("market/submit_deal"); ?>" data-ajax="true" data-ajax-failure="failedConfirm" data-ajax-loading="#spinnnerGo" data-ajax-method="POST" data-ajax-success="successConfirm" id="BuySubmit" method="post" novalidate="novalidate">
				<input name="__RequestVerificationToken" value="#" type="hidden"><input data-val="true" data-val-number="The field ContractId must be a number." data-val-required="The ContractId field is required." id="ContractId" name="ContractId" value="2844" type="hidden">            <input id="TradeType" name="TradeType" value="1" type="hidden">
					<div class="form-group">
						<label for="InputShares">Number of Shares</label>
						<div class="shares_buttons">
							<p>
								<button type="button" class="btn btn-default addcount" id="15">15</button>
								<button class="btn btn-default addcount" type="button" id="75">75</button>
								<button class="btn btn-default addcount" type="button" id="150">150</button>
								<button class="btn btn-default addcount" type="button" id="300">300</button>
								<button class="btn btn-default addcount" type="button" id="450">450</button>
							</p>
						</div>
						<div class="validation-error x-long full-width">
							<span class="field-validation-valid" data-valmsg-for="Quantity" data-valmsg-replace="true"></span>
							<div class="perror perror_off" id="quantity_required"></div>
							<input  class="form-control full-width quantityBuy valid" data-val="true" data-val-number="The field Quantity must be a number." data-val-regex="Only postive whole numbers are allowed" data-val-regex-pattern="^([1-9][0-9]*)$" data-val-required="Quantity is required" id="Quantity" min="1" name="Quantity" placeholder="Enter Quantity" value="<?php if(!empty($offers)){ echo $offers[0]->shares; } ?>" aria-required="true" aria-invalid="false" aria-describedby="Quantity-error" type="number">
						</div>
					</div>

					<div class="form-group">
						<label for="InputPrice">Maximum Price (1<span style="font-family: helvetica;">¢</span> to 99<span style="font-family: helvetica;">¢</span>)</label>   
						<div class="validation-error x-long full-width">
							<span class="field-validation-valid" data-valmsg-for="PricePerShare" data-valmsg-replace="true"></span>
							<div class="perror perror_off" id="Price_required"></div>
							<div class="input-group">               
								<input class="form-control full-width priceBuy" data-val="true" data-val-number="The field PricePerShare must be a number." data-val-range="Price must be between 1¢ and 99¢" data-val-range-max="99" data-val-range-min="1" data-val-required="Price is required" id="PricePerShare" max="99" min="1" name="PricePerShare" placeholder="Max. Price (1¢ to 99¢)" value="<?php if(!empty($offers)){ echo $offers[0]->rate; } ?>" type="number">
								<input type="hidden" name="type" id="type" value="<?php echo $type; ?>" >
								<input type="hidden" name="deal_type" id="deal_type" value="sell" >
								<input type="hidden" name="option_id" id="option_id" value="<?php echo $option_id; ?>" >
								<input type="hidden" name="question_id" id="question_id" value="<?php echo $q_id; ?>" >
								<span class="input-group-addon"><span style="font-family: helvetica;">¢</span></span>
							</div>
						</div>   
					</div>
			</form>
		</div>

		<div class="col-xs-12 buttons_bottom">
			<div class="float-right">
				<button type="button" class="btn btn-default" onclick="close_jbox()" data-dismiss="modal" id="cancelModal" data-target="#yes_long">Cancel</button>
				<button type="submit" class="btn btn-success" id="submitBuy">Preview</button>
			</div>
		</div>
	</div>
</div>
</div>

</div>

</div>
<!--  </div>  -->


	<script>
			$(document).ready(function(){
				$(".addcount").click(function(){
					$("#Quantity").val(this.id);
				});
				
				$(".contractOffer").click(function(){
					var id = this.id;
					var st = id.split('-');
					var qty = $("#shr"+st[1]).val();
					var rt = $("#rat"+st[1]).val();
					$("#Quantity").val(qty);
					$("#PricePerShare").val(rt);
				});
				$("#submitBuy").click(function(){
					var Quantity_q =$('#Quantity').val();
					var PricePerShare_q =$('#PricePerShare').val();
					
					
					if(Quantity_q == '' && PricePerShare_q == ''){
					var ms = 'The field Quantity must be a number.';
                    $('#quantity_required').html(ms);
                    $('#quantity_required').removeClass('perror_off').addClass('perror_on');
					
					var ms = 'The field PricePerShare must be a number.';
                    $('#Price_required').html(ms);
                    $('#Price_required').removeClass('perror_off').addClass('perror_on');
					
					return false;
					}
					
					if(Quantity_q == ''){
					var ms = 'The field Quantity must be a number.';
                    $('#quantity_required').html(ms);
                    $('#quantity_required').removeClass('perror_off').addClass('perror_on');
					return false;
					}else{
					$('#quantity_required').removeClass('perror_on').addClass('perror_off');
					}
					
					if(PricePerShare_q == ''){
					var ms = 'The field PricePerShare must be a number.';
                    $('#Price_required').html(ms);
                    $('#Price_required').removeClass('perror_off').addClass('perror_on');
					return false;
					}else{
					$('#Price_required').removeClass('perror_on').addClass('perror_off');
					}
					
					var ur = "<?php echo base_url("market/submit_deal"); ?>";
					$("#BuySubmit").attr('action',ur);
					
					$("#BuySubmit").submit();
				});
			});
	</script>
