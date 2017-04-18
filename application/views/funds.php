<div class="my-share">
  <div class="send_runner user-profile">
    <div class="container">
      <div class="row">
        <!--tab start here-->
        <div class="user-detail-edit">
          <section>
            <div class="col-sm-2">
              <div class="left-side-profile">
                <div class="avatar-view text-center" title="" data-original-title="Change the avatar"> 
				<?php if($profile->profile_img != '') {?>
                              <img src="<?php echo base_url(); ?>profile_img/<?php echo $profile->profile_img; ?>" height="151" width="220" alt="Avatar">
							  <?php }else{ ?>
							  <img src="<?php echo base_url(); ?>img/no_bk.jpg" alt="Avatar">
							  <?php } ?> 
				</div>
                <?php include('left_bar.php'); ?>
              </div>
            </div>
            <div class="col-sm-10">
              <div class="right-side-user">
			  
			  <?php $msgs = explode('|',$this->session->flashdata('msg'));
              	if($msgs[0] == 'pass'){ ?>
                  <div role="alert" class="alert alert-success alert-dismissible fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                                    <!--<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>-->
                                   <?php echo $msgs[1]; ?>
                  </div>
             	<?php }if($msgs[0] == 'fail'){ ?>
                  <div role="alert" class="alert alert-danger alert-dismissible fade in">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>
                                    <!--<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>-->
                                      <?php echo $msgs[1]; ?>
                                </div>
             	<?php } ?>
			  
                <h2>Funds</h2>
                <!--   Update your profile-->
                <div class="set-box">
                  <div class="profile-tab">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="active"><a href="#Account-Balance" aria-controls="Account-Balance" role="tab" data-toggle="tab" aria-expanded="true">Account Balance</a></li>
                      <li class=""><a href="#Deposit-Funds" aria-controls="Deposit-Funds" role="tab" data-toggle="tab" aria-expanded="false">Deposit Funds</a></li>
                      <li><a href="#Withdraw-Funds" aria-controls="Withdraw-Funds" role="tab" data-toggle="tab" aria-expanded="true">Withdraw Withdraw</a></li>
                      <li class=""><a href="#Transaction-History" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">Transaction History</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="Account-Balance">
                        <h3 class="margintop15">Account Balance</h3>
                        <div class="fund-with">
                          <div class="row">
                            <div class="col-sm-6"> Available Funds: </div>
							<?php $id = $this->session->userdata('id'); if($id != '') { 
								  $balance = $this->session->userdata('balance');
								  $invested = $this->session->userdata('invested');
								  $gain_loss = $this->session->userdata('gain_loss');
								  }
							?>
                            <div class="col-sm-3"> <span class="label-custom label-success white"><?php if($balance != ''){ echo $this->sports->showBucks($balance); }else{ echo '$ 0.00';} ?></span> </div>
                          </div>
                        </div>
                        <div class="fund-with">
                          <div class="row">
                            <div class="col-sm-6"> Invested Amount: </div>
                            <div class="col-sm-3"> <span class="label-custom label-success white"><?php if($invested != ''){ echo $this->sports->showBucks($invested); }else{ echo '$ 0.00';} ?></span> </div>
                          </div>
                        </div>
                        <div class="fund-with">
                          <div class="row">
                            <div class="col-sm-6"> Unrealized Gain/Loss: </div>
                            <div class="col-sm-3"> <span class="label-custom label-success white"><?php if($gain_loss != ''){ echo $this->sports->showBucks($gain_loss); }else{ echo '$ 0.00';} ?></span> </div>
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="Deposit-Funds">
                        <h3 class="margintop15">Deposit by Credit Card</h3>
                        <div class="">
                          <div>
                            <label>
                            <input name="images" type="radio">
                            <!--<img class="visaa" src="<?php echo base_url(); ?>img/visa-big-20160808.jpg" style="cursor: pointer; padding-left: 0px;" onClick="loadForm(1);">--> </label>
                          </div>
                          <div class="form">
                            <?php /*?><?php echo base_url('join/checkout'); ?><?php */?>
                            <form name="depositForm" class="login-form" action="<?php echo base_url('funds/deposit_funds'); ?>" method="post" >
                              <input placeholder="Amount in USD" name="amount" ng-model="amount" id="deposit_amount_id"  type="text" required >
                              <button type="submit" class="btn btn-success btn-lg btn-block" id="deposit_funds">Submit</button>
                              <script src="https://checkout.stripe.com/checkout.js"></script>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="Withdraw-Funds">
                        <h3 class="margintop15">You will be able to withdraw funds 30 days after your initial deposit. This service will become active at that time.</h3>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="Transaction-History">
                        <h3 class="margintop15">Transaction History</h3>
                        <table class="table">
                          <tbody>
                            <tr>
                              <th>Type</th>
                              <th>Date (UTC)</th>
                              <th>Transaction Id</th>
                              <th>Amount </th>
                              <th>Status</th>
                            </tr>
							<?php if(!empty($transaction_history) != '') { foreach($transaction_history as $thistory) { 
							$tAmt = $thistory->amount;
							
							?>
                            <tr>
                              <td>Deposit</td>
                              <td><?php echo $thistory->created_date; ?></td>
                              <td ><?php echo $thistory->gateway_transaction_id; ?></td>
                              <td><?php echo $this->sports->showBucks($tAmt); ?></td>
                              <td>Approved</td>
                            </tr>
							<?php } }else{ ?>
							<tr><td><div style="padding:10px; color:#FF0000;">No record found.</div></td></tr>
							<?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--   Update your profile-->
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <!--tab end here-->
  </div>
</div>
