<!--menu-->
<!-- my share-->
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
                            	<h2>History </h2>  
                                <!--   Update your profile-->                           
                                <div class="set-box">
                                	<h3>How many Senate seats will the GOP hold in January?</h3>
                                       <table class="table">
                                            	<tbody>
                                                <tr>
                                                	<th>View Market  </th>
                                                	<th>Type</th>
                                                	<th>Shares</th>
                                                	<th>Avg Price</th>
                                                	<th>Buy Offers</th>
                                                	<th>Sell Offers</th>
                                                	<th>Gain/Loss </th>
                                                	<th class="green-bg-th">Latest</th> 	 	
                                                	<th class="green-bg-th">Buy</th>
                                                	<th class="green-bg-th">Sell</th>
                                                </tr>
                                                <tr>
                                                    <td><img src="<?php echo base_url(); ?>img/video.png" width="30" height="30"> 53 or more </td>
                                                    <td><a class="btn btn-success btn-xs">Yes</a></td>	
                                                    <td>0</td>
                                                    <td>- </td>	
                                                    <td><a class="btn btn-success btn-xs">1</a></td>
                                                    <td>0 	</td>
                                                    <td>$0.00 </td>	
                                                    <td class="text-success">3&cent; 	</td>
                                                    <td class="text-success"><b>3&cent;</b> 	</td>
                                                    <td>2&cent;</td>				
                                                </tr>
                                                
                                                <tr bgcolor="#f1f1f1">
                                                	<td colspan="10" align="right"><b>Your risk in this market: $0.00</b></td>
                                                </tr>
                                            </tbody>
                                            </table>
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