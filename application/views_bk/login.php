<!-- banner-->

<div class="banner">

	<div class="login">

<div class="container">

<div class="row">



<h4 class="home-title margintop45">WELCOME, Please Login</h4>



<div class="login-page">

  <div class="form">
<div style="color:#00CC66;"><?php if($this->session->flashdata('msg') != ''){ echo $this->session->flashdata('msg'); } ?></div>
    <form name="loginForm" class="login-form" action="<?php echo base_url(); ?>user/login" method="post" >

      <input placeholder="Email" name="email" ng-model="email"  type="text" required >

	  <span ng-show="loginForm.email.$touched && loginForm.email.$invalid">The Email is required.</span>

      <input placeholder="Password" name="password" ng-model="password"  type="password" required >

      <span ng-show="loginForm.password.$touched && loginForm.password.$invalid">The Password is required.</span>

	  

	 <button type="submit" class="btn btn-success btn-lg btn-block ">Login</button>

      <p><a href="<?php echo base_url(); ?>home/forgotpassword" class="forget-pass">Forgot Password</a></p>

      <a href="<?php echo base_url(); ?>signup" class="btn btn-success btn-lg btn-block ">Create an Account</a>

      

    </form>

  </div>

</div>

</div>

</div>

</div>

</div>

<!-- banner-->