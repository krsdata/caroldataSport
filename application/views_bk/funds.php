<div class="my-share">
  <div class="send_runner user-profile">
    <div class="container">
      <div class="row">
        <!--tab start here-->
        <div class="user-detail-edit">
          <section>
            <div class="col-sm-3">
              <div class="left-side-profile">
                <div class="avatar-view text-center" title="" data-original-title="Change the avatar"> <img src="<?php echo base_url(); ?>img/picture.jpg" alt="Avatar"> </div>
                <h3 class="text-center">User Name</h3>
                <div class="left-menu">
                  <p><a href="<?php echo base_url(); ?>myshare"><i class="fa fa-share-square-o"></i> My Shares</a></p>
                  <p><a href="<?php echo base_url(); ?>history"><i class="fa fa-history"></i> History</a></p>
                  <p><a href="<?php echo base_url(); ?>funds"><i class="fa fa-usd"></i> Funds</a></p>
                  <p><a href="<?php echo base_url(); ?>setting"><i class="fa fa-cog"></i> Settings</a></p>
                  <p><a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out"></i> Sign Out</a></p>
                </div>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="right-side-user">
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
                            <div class="col-sm-3"> <span class="label-custom label-success white">$9.90</span> </div>
                          </div>
                        </div>
                        <div class="fund-with">
                          <div class="row">
                            <div class="col-sm-6"> Available Funds: </div>
                            <div class="col-sm-3"> <span class="label-custom label-success white">$9.90</span> </div>
                          </div>
                        </div>
                        <div class="fund-with">
                          <div class="row">
                            <div class="col-sm-6"> Available Funds: </div>
                            <div class="col-sm-3"> <span class="label-custom label-success white">$9.90</span> </div>
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="Deposit-Funds">
                        <h3 class="margintop15">Deposit by Credit Card</h3>
                        <div class="">
                          <div>
                            <label>
                            <input name="images" type="radio">
                            <img class="visaa" src="<?php echo base_url(); ?>img/visa-big-20160808.jpg" style="cursor: pointer; padding-left: 0px;" onClick="loadForm(1);"> </label>
                          </div>
                          <div class="form">
                            <?php /*?><?php echo base_url('join/checkout'); ?><?php */?>
                            <form name="depositForm" class="login-form" action="#" method="post" >
                              <input placeholder="Amount in USD" name="amount" ng-model="amount"  type="text" required >
                              <button type="submit" class="btn btn-success btn-lg btn-block" id="stripe-demo">Submit</button>
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
                              <th>Confirmation Number</th>
                              <th>Amount </th>
                              <th>Status</th>
                            </tr>
                            <tr>
                              <td>Deposit</td>
                              <td>12/02/2016</td>
                              <td >45177565711244</td>
                              <td>$10.00</td>
                              <td>Approved</td>
                            </tr>
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
