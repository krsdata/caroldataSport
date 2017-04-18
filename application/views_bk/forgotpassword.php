<!-- banner-->
<div class="banner">
	<div class="login">
<div class="container">
<div class="row">

<h4 class="home-title margintop45">WELCOME, Please Enter Email</h4>

<div class="login-page">
  <div class="form">
    <form class="login-form" name="loginForm" action="<?php echo base_url(); ?>user/forgotpassword" method="post">
      <input placeholder="Email" name="email" ng-model="email" required type="email">
      <span ng-show="loginForm.email.$invalid">The Email is required.</span>
     <button type="submit" href="user-profile.php" class="btn btn-success btn-lg btn-block ">Submit</button>
	 <a href="<?php echo base_url(); ?>login" class="btn btn-success btn-lg btn-block ">Login</a>
     <a href="<?php echo base_url(); ?>signup" class="btn btn-success btn-lg btn-block ">Create an Account</a>
      
    </form>
  </div>
</div>
</div>
</div>
</div>
</div>
<!-- banner-->