<div class="my-share">
  <div class="send_runner user-profile Question_view">
    <div class="container">
      <div class="row">
        <!--tab start here-->
        <div class="user-detail-edit">
          <section>
            <div class="col-sm-2">
              <?php include('innersidebar.php'); ?>
            </div>
            <div class="col-sm-10">
			<?php $id = $this->session->userdata('id'); if($id == ''){ ?>
							 	<div class="alert alert-success">
								    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
                                    <h2>Sign Up for Full Benefits!</h2>
									<p>You can make use of all of PredictIt's features only by opening an account.</p>
									<p class="hidden-xs">
										<a href="<?php echo base_url(); ?>signup" class="btn btn-warning btn-success">Sign Up Now</a>
										<a href="<?php echo base_url(); ?>login" class="btn btn-default">Or Sign In</a>
									</p>
                                </div>
								<?php } ?>
              <div class="right-side-user white_bg">
                <!-- 	<ol class="breadcrumb">
                                  <li><a href="#">NBA  </a></li>
                                  <li><a href="#">Supreme Court</a></li>
                                </ol>   -->
                <!--   Update your profile-->
                <div class="set-box white_bg">
                  <div class="feature-detial profile-tab ">
                    <div class="feature-top">
                      <div class="row">
                        <div class="col-xs-12 col-sm-2 no-padding" style="padding-left: 15px"> <img src="<?php if($question->image == '-') { echo base_url(); ?>img/no.jpg<?php  }else{ echo IMG_QUESTION_ADMIN.$question->image; } ?>" alt="" class="img-rounded img-responsive"> </div>
                        <div class="col-xs-12 col-sm-10">
                          <h3 style="margin-top: 1px; display: inline-block;margin-bottom: 5px; color:#8EC433"><?php echo $question->question; ?></h3>
                          <p style="margin-bottom: 5px;"><b>End Date:</b> N/A</p>
                          <p style="margin-bottom: 5px;"> <b>Status:</b> <span class="SPMarketStatus">Open</span> </p>
                        </div>
                        <div class="col-xs-12 col-sm-10" id="divUserRisk" style="display: none;">
                          <p> <a class="showPointer">Your risk in this market: <span class="SPUserRisk">$0.00</span> <span class="glyphicons calculator" title="Calculator table" style="cursor: pointer; top: 3px; margin-left: 2px;"></span> </a> </p>
                        </div>
                      </div>
                      <!--tab-->
                      <ul class="nav nav-tabs margintop20">
                        <li class="active"><a href="#outcomes" id="getContract" data-toggle="tab">Contracts</a></li>
                        <li class=""><a href="#rules" data-toggle="tab" id="getRules">Rules</a></li>
                        <!--  <li class=""><a href="#tabChart" data-toggle="tab" id="getTabChart">Chart</a></li>
        <li class=""><a href="#history" id="getHistory" data-toggle="tab" class="tabClick">History</a></li>  -->
                      </ul>
                      <!-- tabl-centent-->
                      <div class="tab-content">
                        <div class="tab-pane active" id="outcomes">
                          <div id="contractList">
                            <input id="marketId" name="marketId" value="2198" type="hidden">
                            <p style="font-size:12px; padding-top:20px;">Trade shares from this page by clicking any price in bold. For more information on an individual prediction, click on the name or image.</p>
                            <div class="hidden-xs">
                              <div class="panel panel-default activity">
                                <div class="panel-body">
                                  <div class="table-responsive">
                                    <table id="contractListTable" class="table">
                                      <thead>
                                        <tr class="contract-header">
                                          <th class="contract-title" style="text-align: left"> <span class="sharesHeader" style="padding-left: 5px;"> <a class="glyphicons refresh" title="Refresh (ALT+R)" accesskey="r" aria-hidden="true" style="padding-left: 20px; color: darkgreen; margin-top: 4px; cursor: pointer" onclick="TradeRefresh()"></a> OPTION TITLE </span> </th>
                                          <?php $us = $this->session->userdata('id'); ?>
                                          <th class="text-center">Latest</th>
										  <th class="text-center">Buy Yes</th>
                                          <th class="text-center">Sell Yes</th>
                                          <th class="text-center">Buy No</th>
                                          <th class="text-center">Sell No</th>
                                          <?php if(!empty($us)) { ?>
                                          <th class="text-center">Shares</th>
                                          <th class="text-center">Buy Offers</th>
                                          <th class="text-center">Sell Offers</th>
                                          <?php } ?>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php foreach( $options as $opt ) { ?>
                                        <tr class="" style="background-color: rgb(249, 249, 249);">
                                          <td><div id="outcome">
                                              <div class="outcome"> <a href="">
                                                <?php if($opt['option_image']=='-'){ ?>
                                                <img src="<?php echo base_url();?>img/no.jpg" width="75" />
                                                <?php }else{ ?>
                                                <img src="<?php echo $opt['option_image']; ?>" alt="<?php echo $opt['option_name']; ?>" width="75" />
                                                <?php } ?>
                                                </a> </div>
                                              <div class="outcome-title"> <a href="">
                                                <h4><?php echo $opt['option_name']; ?></h4>
                                                <p></p>
                                                </a> </div>
                                            </div></td>
											<td class="text-center"><span class="sharesUp">
                                            <?php 
											$latest = $this->sports->getLatestRate($opt['option_id']);
											//print_r($latest); die;
											if(empty($latest))
											{
												echo 'NC';	
											}
											else
											{
												if(isset($deviation) && !empty($deviation))
												{
													if($deviation > 0)
													{
														echo $deviation.' <i class="fa fa-arrow-up" aria-hidden="true"></i>';
													}else if($deviation < 0)
													{
														echo $deviation.' <i class="fa fa-arrow-down" aria-hidden="true"></i>';
													}
													else{ echo 'NC'; }
												}
												echo $latest->buy_rate;
												
											}
											?>
											
											<span style="font-family: helvetica;">&cent;</span>
                                            </span> </td>
                                          <td class="text-center"><span class="sharesUp">
                                            <?php 
if(!empty($us) && (($opt['buyoffercount'][0]->type == 'yes' || $opt['buyoffercount'][0]->type == '') && ($opt['sharecount']->type == 'yes' || $opt['sharecount']->type == '' ))){ echo '<a class="showPointer sharesUp nyroModal"  href="'.base_url("browse/buySharePopup/".$opt['option_id']."/yes/".$question->id).'" id=""><strong>'; } else { echo ''; } ?>
                                            <?php $buyyes = $this->sports->get_min_max_rate($opt['option_id'],'yes','buy'); 
													if(empty($buyyes)){ echo "None"; } else{ echo $buyyes; ?>
                                            <span style="font-family: helvetica;">&cent;</span>
                                            <?php }
if(!empty($us) && (($opt['buyoffercount'][0]->type == 'yes' || $opt['buyoffercount'][0]->type == '') && ($opt['sharecount']->type == 'yes' || $opt['sharecount']->type == '' ))){ echo "</strong></a>"; } else { echo ''; } 
													?>
                                            </span> </td>
                                          <td class="text-center"><span class="sharesUp">
                                            <?php if( !empty($us) && ($opt['sharecount']->type == 'yes' && $opt['sharecount']->rowcount != '' )){ echo '<a class="showPointer sharesUp nyroModal"  href="'.base_url("browse/sellSharePopup/".$opt['option_id']."/yes/".$question->id).'" id=""><strong>'; } else { echo ''; } ?>
                                            <?php $sellyes = $this->sports->get_min_max_rate($opt['option_id'],'yes','sell'); 
													if(empty($sellyes)){ echo "None"; } else{ echo $sellyes; ?>
                                            <span style="font-family: helvetica;">&cent;</span>
                                            <?php }
if( !empty($us) && ($opt['sharecount']->type == 'yes' && $opt['sharecount']->rowcount != '' )){ echo "</strong></a>"; } else { echo ''; }  													
													?>
                                            </span> </td>
                                          <td class="text-center"><span class="sharesDown" style="color:red;">
                                            <?php if(!empty($us) && (($opt['buyoffercount'][0]->type == 'no' || $opt['buyoffercount'][0]->type == '') && ($opt['sharecount']->type == 'no' || $opt['sharecount']->type == '' ))){ echo '<a class="showPointer sharesUp nyroModal"  href="'.base_url("browse/buySharePopup/".$opt['option_id']."/no/".$question->id).'" id=""><strong>'; } else { echo ''; } ?>
                                            <?php $buyno = $this->sports->get_min_max_rate($opt['option_id'],'no','buy'); 
													if(empty($buyno)){ echo "None"; } else{ echo $buyno; ?>
                                            <span style="font-family: helvetica;">&cent;</span>
                                            <?php }
if(!empty($us) && (($opt['buyoffercount'][0]->type == 'no' || $opt['buyoffercount'][0]->type == '') && ($opt['sharecount']->type == 'no' || $opt['sharecount']->type == '' ))){ echo '</strong></a>'; } else { echo ''; } 													
													?>
                                            </span> </td>
                                          <td class="text-center"><span class="sharesDown" style="color:red;" >
                                            <?php if( !empty($us) && ($opt['sharecount']->type == 'no' && $opt['sharecount']->rowcount != '' )){ echo '<a class="showPointer sharesUp nyroModal"  href="'.base_url("browse/sellSharePopup/".$opt['option_id']."/no/".$question->id).'" id=""><strong>'; } else { echo ''; } ?>
                                            <?php $sellno = $this->sports->get_min_max_rate($opt['option_id'],'no','sell'); 
											if(empty($sellno)){ echo "None"; } else{ echo $sellno; ?>
                                            <span style="font-family: helvetica;">&cent;</span>
                                            <?php }
if( !empty($us) && ($opt['sharecount']->type == 'no' && $opt['sharecount']->rowcount != '' )){ echo "</strong></a>"; } else { echo ''; }													
												?>
                                            </span> </td>
                                          <?php if(!empty($us)) { ?>
                                          <td class="text-center"><b class="label alert-grey label-lg">
                                            <?php if(  $opt['sharecount']->rowcount != '' ){ echo '<a class="showPointer sharesUp nyroModal"  href="'.base_url("browse/ownershipPopup/".$opt['option_id']."/".$question->id).'"  id=""><strong>'.$opt['sharecount']->rowcount.'</strong></a>'; } else { echo '0'; } ?>
                                            </b></td>
                                          <td class="text-center"><b class="label alert-grey label-lg">
                                            <?php if($opt['buyoffercount'][0]->shares != '' ){ echo '<a class="showPointer sharesUp nyroModal" href="'.base_url("browse/ownershipPopup/".$opt['option_id']."/".$question->id).'" id=""><strong>'.$opt['buyoffercount'][0]->shares.'</strong></a>'; } else { echo '0'; } ?>
                                            </b></td>
                                          <td class="text-center"><b class="label alert-grey label-lg">
                                            <?php if($opt['selloffercount'][0]->shares != '' ){ echo '<a class="showPointer sharesUp nyroModal" href="'.base_url("browse/ownershipPopup/".$opt['option_id']."/".$question->id).'" id=""><strong>'.$opt['selloffercount'][0]->shares.'</strong></a>'; } else { echo '0'; } ?>
                                            </b></td>
                                          <?php } ?>
                                        </tr>
                                        <?php  } ?>
                                        <!--  <tr id="showMoreLink" class="" onclick="toggleMore();" style="cursor: pointer; background-color: rgb(249, 249, 249);">
                                <td id="showMoreLinkContent" colspan="9" style="text-align: center; padding: 10px; background-color: #DDD; color: #167297; font-weight: bold">Show More <span class="glyphicons glyphicon-chevron-down"></span></td>
                            </tr>  -->
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal fade" id="yes_long" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                              <div class="modal-dialog ui-draggable">
                                <div class="modal-content">
                                  <div class="modal-header ui-draggable-handle" style="cursor: pointer;">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Buy Yes</h4>
                                  </div>
                                  <div class="modal-body" style="overflow: hidden">
                                    <div id="showBuy"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal fade" id="yes_longsell" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                              <div class="modal-dialog ui-draggable">
                                <div class="modal-content">
                                  <div class="modal-header ui-draggable-handle" style="cursor: pointer;">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Sell Yes</h4>
                                  </div>
                                  <div class="modal-body" style="overflow: hidden">
                                    <div id="showlongsell"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal fade" id="no_short" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                              <div class="modal-dialog ui-draggable">
                                <div class="modal-content">
                                  <div class="modal-header ui-draggable-handle" style="cursor: pointer;">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Buy No</h4>
                                  </div>
                                  <div class="modal-body" style="overflow: hidden">
                                    <div id="showSell"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal fade" id="no_shortsell" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                              <div class="modal-dialog ui-draggable">
                                <div class="modal-content">
                                  <div class="modal-header ui-draggable-handle" style="cursor: pointer;">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Sell No</h4>
                                  </div>
                                  <div class="modal-body" style="overflow: hidden">
                                    <div id="showshortsell"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div> <img id="spinnerContractList" class="spinner-center" src="https://az620379.vo.msecnd.net/images/loading.gif" alt="Loading Spinner" style="display: none"> </div>
                        </div>
                        <div class="tab-pane" id="rules">
                          <div class="tab-c">
                            <p style="padding-top: 10px;"> <?php echo $question->description_rules; ?> </p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                          </div>
                        </div>
                      </div>
                      <!--tab-content-->
					  
					   	<!-- commewnt-->
							<div class="row">
							<div class="col-md-12">
							  <h2 class="page-header">Comments</h2>
							  	<!--<div align="center"  id="showdiv" class="alert"></div>-->
								<div class="alert alert-success" id="showdiv" style="display:none;">
								    <button aria-label="Close" data-dismiss="alert" class="close glyphicon glyphicon-remove-circle" type="button"></button>
                                    <h2 align="center">Your comment successfully post.!</h2>
                                </div>
								
								<div class="row">
								<form name="commentfrm" id="commentfrm" method="post">
								<input type="hidden" name="question_id" id="question_id" value="<?php echo $question->id; ?>"  />
								<input type="hidden" name="userId" id="userId" value="<?php echo $this->session->userdata('id'); ?>"  />
								<div class="col-sm-12">
									<textarea class="form-control" name="comment" id="comment"></textarea>
								</div>
								
								<div class="col-sm-12 text-right margintop10">
									<input type="submit" name="submit" value="Post" onclick="return myFunction();" class="btn btn-success" />
								</div>
								
								</form>
								</div>
								<br>
								<section class="comment-list">
								  <!-- First Comment -->
								  	<div id="com_id">
								  <?php foreach($comment as $cdata){
				$data['userdata'] = $this->Common_model->getsingle('ai_users', array('id' => $cdata->user_id), 'id,mobile,username,firstname,lastname,profile_img');
				
					if($data['userdata']->profile_img != ''){
					$pimg = base_url().'profile_img/'.$data['userdata']->profile_img;
					}else{
					$pimg = base_url().'profile_img/noImg.jpg';
					}
					$username = $data['userdata']->username;
					$fullname = $data['userdata']->firstname.' '.$data['userdata']->lastname;
					$date = new DateTime($cdata->added_date);
					?>
								  <article class="row">
										<div class="col-md-2 col-sm-2 hidden-xs">
										  <figure class="thumbnail">
											<img class="img-responsive" src="<?php echo $pimg; ?>" />
											<figcaption class="text-center"><?php echo $username; ?></figcaption>
										  </figure>
										</div>
										<div class="col-md-10 col-sm-10">
										  <div class="panel panel-default arrow left">
											<div class="panel-body">
											  <header class="text-left">
												<div class="comment-user"><i class="fa fa-user"></i> <?php echo $fullname; ?></div>
												<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $date->format('M d, Y'); ?></time>
											  </header>
											  <div class="comment-post">
												<p><?php echo $cdata->comment; ?></p>
											  </div>
											</div>
										  </div>
										</div>
								</article>
								  <?php } ?></div>
								</section>
							</div>
						  </div>
    					<!--comment-->
					  
                      <!-- tab-->
                    </div>
                  </div>
                </div>
                <!--   Update your profile-->
              </div>
            </div>
          </section>
        </div>
      </div>
      <!--tab end here-->
    </div>
  </div>
</div>
<!-- my share-->
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<script type="text/javascript">
//$('.alert').fadeOut(10000);

function myFunction() {
var userId = document.getElementById("userId").value;
if(userId == ''){
alert("Firstly login then you can comments on question.!");
return false;
}

var comment = document.getElementById("comment").value;
var question_id = document.getElementById("question_id").value;
// Returns successful data submission message when the entered information is stored in database.
var dataString = 'comment1=' + comment + '&question_id1=' + question_id;
if (comment == '') {
alert("Please fill comments field.!");
return false;
} else {
// AJAX code to submit form.
$.ajax({
type: "POST",
url: "<?php echo base_url();?>comment",
data: dataString,
cache: false,
success: function(result) { 
$("#com_id").html(result);
$("#comment").val('');
$("#showdiv").show();
}
});
}
return false;
}
</script>