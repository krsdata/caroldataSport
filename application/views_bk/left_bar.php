<h3 class="text-center"><?php echo $this->session->userdata('username'); ?></h3>
<div class="left-menu">
  <p><a href="<?php echo base_url(); ?>myshare"><i class="fa fa-share-square-o"></i> My Shares</a></p>
  <p><a href="<?php echo base_url(); ?>history"><i class="fa fa-history"></i> History</a></p>
  <p><a href="<?php echo base_url(); ?>funds"><i class="fa fa-usd"></i> Funds</a></p>
  <p><a href="<?php echo base_url(); ?>setting"><i class="fa fa-cog"></i> Settings</a></p>
  <p><a href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out"></i> Sign Out</a></p>
</div>