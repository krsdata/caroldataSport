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
			  <input placeholder="First Name" name="name" ng-model="name" required type="text" tabindex="1">
			  <span ng-show="loginForm.name.$invalid">The First Name is required.</span>

			  <input placeholder="Email" name="email" ng-model="email" required type="email" tabindex="3">
		      <span ng-show="loginForm.email.$invalid">The Email is required.</span>

			  <input placeholder="Password"  name="password" ng-model="password" required type="password" tabindex="5">
			  <span ng-show="loginForm.password.$invalid">The Password is required.</span>
			</div>

			<div class="col-md-6 col-sm-6">
			  <input placeholder="Last Name" name="lastname" ng-model="lastname" required type="text" tabindex="2">
			  <span ng-show="loginForm.lastname.$invalid">The Last Name is required.</span>
			  
			  <input placeholder="Confirm Email"  name="con_email" ng-model="con_email" required type="email" tabindex="4">
		      <span ng-show="loginForm.con_email.$invalid">The Confirm Email is required.</span>

			  <input placeholder="Confirm Password" name="confirmPassword" ng-model="confirmPassword" required type="password" tabindex="6">
		      <span ng-show="loginForm.confirmPassword.$invalid">The confirmPassword is required.</span>
			</div>

		   	<div class="col-md-6 col-sm-6">
		   	<input placeholder="UserName" name="userName" ng-model="userName" required type="text" tabindex="7">
			<span ng-show="loginForm.userName.$invalid">The UserName is required.</span>
		   
		   	<input placeholder="Phone" name="mobile"  ng-model="mobile"  required type="text" tabindex="9">
		    <span ng-show="loginForm.mobile.$invalid">The Phone is required.</span>
			
			<input placeholder="Country of Residence" name="country"  ng-model="country"  required type="text" tabindex="11">
		    <span ng-show="loginForm.country.$invalid">The Country is required.</span>
		   </div>
		   
		   	<div class="col-md-6 col-sm-6">      
		   	<input placeholder="Address"  name="address" ng-model="address" required type="text" tabindex="8">
		    <span ng-show="loginForm.address.$invalid">The Address is required.</span>
			
			<input placeholder="Zip Code" name="zip_code" ng-model="zip_code" required type="text" tabindex="10">
		    <span ng-show="loginForm.zip_code.$invalid">The Zip Code is required.</span>
			
			<!--<select name="dob_day" ng-model="dob_day" class="form-control">
			  <option value="">Day</option>
			  <option value="01">01</option>
			  <option value="02">02</option>
			  <option value="03">03</option>
			  <option value="04">04</option>
			  <option value="05">05</option>
			  <option value="06">06</option>
			  <option value="07">07</option>
			  <option value="08">08</option>
			  <option value="09">09</option>
			  <option value="10">10</option>
			  <option value="11">11</option>
			  <option value="12">12</option>
			  <option value="13">13</option>
			  <option value="14">14</option>
			  <option value="15">15</option>
			  <option value="16">16</option>
			  <option value="17">17</option>
			  <option value="18">18</option>
			  <option value="19">19</option>
			  <option value="20">20</option>
			  <option value="21">21</option>
			  <option value="22">22</option>
			  <option value="23">23</option>
			  <option value="24">24</option>
			  <option value="25">25</option>
			  <option value="26">26</option>
			  <option value="27">27</option>
			  <option value="28">28</option>
			  <option value="29">29</option>
			  <option value="30">30</option>
			  <option value="31">31</option>
		</select>
		
			<select name="dob_month" ng-model="dob_month" class="form-control">
			  <option value="">Month</option>
			  <option value="01">January</option>
			  <option value="02">February</option>
			  <option value="03">March</option>
			  <option value="04">April</option>
			  <option value="05">May</option>
			  <option value="06">June</option>
			  <option value="07">July</option>
			  <option value="08">August</option>
			  <option value="09">September</option>
			  <option value="10">October</option>
			  <option value="11">November</option>
			  <option value="12">December</option>
			</select>-->
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