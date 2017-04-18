
<!--About-->
<div class="business_solution_1"> 
<h4 class="home-title margintop25">
<?php if($about_data != ''){
echo $aboutTitle = $about_data->title;
}?></h4>
</div>
<!--About-->

<!-- Content-->
<div class="about-us">
<div class="container">
	<div class="row">
    	<div class="col-sm-9">
        	<div class="left-side-content">
            	<?php if($about_data != ''){
						echo $aboutContent = $about_data->content;
				} ?>		
            </div>
        </div>
    	<div class="col-sm-3">
        		<?php include('right_bar.php'); ?>        	
        </div>
    </div>
</div>
</div>
<!-- Content-->