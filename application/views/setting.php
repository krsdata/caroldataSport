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
							<?php $msgs = explode('|',$this->session->flashdata('msg'));
										if($msgs[0] == 'pass'){ ?>
										<div role="alert" class="alert alert-success alert-dismissible fade in">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>				
										<?php echo $msgs[1]; ?>
										  </div>
										<?php }if($msgs[0] == 'fail'){ ?>
										  	<div role="alert" class="alert alert-danger alert-dismissible fade in">
										  	<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">&times;</a>				
                            				<?php echo $msgs[1]; ?>
                                </div>
             					<?php } ?>
                            	<h2>Profile</h2>  
                                
                                <!--   Update your profile-->                           
                                <div class="set-box">
                                	<h3>Update your profile</h3>
									<?php $email = $this->session->userdata('email');	 ?>
									
									<form name="ProfileEdit" id="ProfileEdit" method="post" action="<?php echo base_url(); ?>pages/setting"  enctype="multipart/form-data"> 
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label">Mobile</label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
                                                <input class="form-control"  name="mobile" value="<?php echo !empty($profile->mobile) ? $profile->mobile : 'n/a'; ?>" type="text" placeholder="Mobile" required>
												<?php  if (form_error('mobile') != '') {
									   						echo form_error('mobile', '<span class="perror">', '</span>');
												}?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label">Username</label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
                                                <input class="form-control" name="username" value="<?php echo!empty($profile->username) ? $profile->username : 'n/a'; ?>" type="text" placeholder="Username" required>
												<?php  if (form_error('username') != '') {
									   						echo form_error('username', '<span class="perror">', '</span>');
												}?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label">Name</label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
                                                <input class="form-control" name="fname" value="<?php echo!empty($profile->firstname) ? $profile->firstname : 'n/a'; ?>" type="text" placeholder="Name" required>
												<?php  if (form_error('fname') != '') {
									   						echo form_error('fname', '<span class="perror">', '</span>');
												}?>
                                            </div>
                                        </div>
            
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label">Email</label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
                                                <input class="form-control" name="email"  value="<?php echo!empty($email) ? $email : 'n/a'; ?>" disabled="disabled" type="text">
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label">Image</label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
                                                <input class="form-control" name="profileimage" type="file">
												
												 <input name="profile_img" type="hidden" value="<?php echo $profile->profile_img; ?>">
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label"></label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
											<button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                            		</div> 
									</form>                           
                                <!--   Update your profile-->
                                
                                
                                
                                <!--   Update your profile-->                           
                                <div class="set-box">
                                	<h3>Change your password</h3>
									
									<form name="password_reset" id="password_reset" method="post" action="<?php echo base_url(); ?>pages/change_password"  enctype="multipart/form-data"> 
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label">Current password</label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
                                                <input class="form-control" type="password" name="old_pass" id="old_pass" placeholder="Current Password" value="" autocomplete="off">					<?php  if (form_error('old_pass') != '') {
									   						echo form_error('old_pass', '<span class="perror">', '</span>');
												}?>
												
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label">New password</label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
											<input type="password" class="form-control" name="new_pass" id="new_pass" placeholder="New Password" value="" autocomplete="off">							<?php  if (form_error('new_pass') != '') {
									   						echo form_error('new_pass', '<span class="perror">', '</span>');
												}?>	
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label">Confirm new password</label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
											<input type="password" class="form-control" name="new_cpass" id="new_cpass" placeholder="Confirm New Password" value="" autocomplete="off">				<?php  if (form_error('new_cpass') != '') {
									   						echo form_error('new_cpass', '<span class="perror">', '</span>');
												}?>
                                            </div>
                                        </div>            
                                        <div class="form-group">
                                            <label class="col-md-2 col-sm-4 col-xs-12 control-label"></label>
                                            <div class="col-md-6 col-sm-8 col-xs-12">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
										</form>
                            		</div>                            
                                <!--   Update your profile-->
                                    
                                </div>
                            </div>
                    </section></div>
                
            </div>
        <!--tab end here--> 
        </div>
    </div>    	
</div>
<!-- my share-->
<!--footer-->