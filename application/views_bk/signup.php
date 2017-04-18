<!-- banner-->

<div class="banner">

	<div class="login">

<div class="container">

<div class="row">



<h4 class="home-title margintop45">Create Account</h4>



<div class="login-page_2">

  <div class="form_2">
	<div style="color:#00CC66;"><?php if($this->session->flashdata('msg') != ''){ echo $this->session->flashdata('msg'); } ?></div>
    <form class="login-form" name="loginForm" action="<?php echo base_url(); ?>user/registration" method="post" >

    <div class="row">

		  

			  <div class="col-md-6 col-sm-6">

			  <input placeholder="Full Name" name="name" ng-model="name" required type="text">

			  <span ng-show="loginForm.name.$invalid">The Name is required.</span>

			  <input placeholder="UserName"  name="userName" ng-model="userName" required type="text">

			  <span ng-show="loginForm.userName.$invalid">The UserName is required.</span>

			  <input placeholder="Password"  name="password" ng-model="password" required type="password">

			  <span ng-show="loginForm.password.$invalid">The Password is required.</span>

			  </div>

		  

		   <div class="col-md-6 col-sm-6">      

		   <input placeholder="Email"   name="email" ng-model="email" required type="email">

		    <span ng-show="loginForm.email.$invalid">The Email is required.</span>

		   <input placeholder="Phone"   name="mobile"  ng-model="mobile"  required type="text">

		    <span ng-show="loginForm.mobile.$invalid">The Phone is required.</span>

		   <input placeholder="Confirm Password" name="confirmPassword" ng-model="confirmPassword" required type="password">

		    <span ng-show="loginForm.confirmPassword.$invalid">The confirmPassword is required.</span>

		   <!-- <input placeholder="Verification Code" type="text"> -->

		   </div>

      </div>

      <div class="col-md-12 text-left">

      <label for="checkboxes-0"><input id="checkboxes-0" type="checkbox" required> I agree to Sports Swaps <span><a href="#" class="forget-pass">terms and conditions</a></span> and <span><a class="forget-pass" href="#">privacy policy</a></span>.</label> 

      </div>

        

      

       <button type="submit" href="#" class="btn btn-success btn-lg">Create an Account</button>

      

    </form>

  </div>

</div>

</div>

</div>

</div>

</div>

<!-- banner-->