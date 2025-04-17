<!DOCTYPE html>
<html>
<head>
    
    
    
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://use.fontawesome.com/releases/v5.12.1/js/all.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="custom.css">
    
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,400,500,600" rel="stylesheet" type="text/css">
    
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="footer.css">
<link rel="stylesheet" href="style.css">



 <!-- CSS here -->
  
   
   


<script>
    function submitButtonStyle() { 
document.getElementsByClassName("stylebutton").style.backgroundColor = "red"; }
</script>



<!-- exp -->

<script src="js/classie.js"></script> 
<script src="js/gnmenu.js"></script>
<script>
new gnMenu( document.getElementById( 'gn-menu' ) );
</script>


</head>
<body style="background:#F5F5F5;">


 
   <ul id="gn-menu" class="gn-menu-main">
<li class="gn-trigger"> <a class="gn-icon gn-icon-menu"><span><a href="https://www.jqueryscript.net/menu/">Menu</a></span></a>
<nav class="gn-menu-wrapper">
<div class="gn-scroller">
<ul class="gn-menu">
<li class="gn-search-item">
<input placeholder="Search" type="search" class="gn-search">
<a class="gn-icon gn-icon-search"><span>Search</span></a> </li>
<li> <a class="gn-icon gn-icon-download">Downloads</a>
<ul class="gn-submenu">
<li><a class="gn-icon gn-icon-illustrator">Vector Illustrations</a></li>
<li><a class="gn-icon gn-icon-photoshop">Photoshop files</a></li>
</ul>
</li>
<li><a class="gn-icon gn-icon-cog">Settings</a></li>
<li><a class="gn-icon gn-icon-help">Help</a></li>
<li> <a class="gn-icon gn-icon-archive">Archives</a>
<ul class="gn-submenu">
<li><a class="gn-icon gn-icon-article">Articles</a></li>
<li><a class="gn-icon gn-icon-pictures">Images</a></li>
<li><a class="gn-icon gn-icon-<a href="https://www.jqueryscript.net/tags.php?/video/">video</a>s">Videos</a></li>
</ul>
</li>
</ul>
</div>
<!-- /gn-scroller --> 
</nav>
</li>
</ul>
 

 <?php

$api_url = 'https://api.covid19india.org/v2/state_district_wise.json';

// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
$user_data = json_decode($json_data,true);

$totalcases=0;
foreach ($user_data as $data) {
foreach ($data['districtData'] as $Distdata) {
$totalcases=$totalcases+$Distdata['confirmed'];
}
}

// LOGIC for counting State Cases
$totalcasesinup=0;
$totalcasesinMaharastra=0;
$totalcasesinDelhi=0;
$totalcasesinRajasthan=0;
$totalinGujarat=0;
$totalinTamilNadu=0;
$totalinMP=0;
$totalinTel=0;
$totalinAndhraP=0;
$totalinKerala=0;
$totalinKarnataka=0;
$totalinJK=0;
$totalinWB=0;
$totalinHaryana=0;
$totalinPunjab=0;
$totalinBihar=0;
$totalinOdisa=0;
$totalinUK=0;
$totalinJharkhand=0;
$totalinHP=0;
$totalinChattis=0;
$totalinLadakh=0;
$totalinGoa=0;

foreach ($user_data as $data) {
	if($data['state']=='Uttar Pradesh')
foreach ($data['districtData'] as $Distdata) {
$totalcasesinup=$totalcasesinup+$Distdata['confirmed'];
}

if($data['state']=='Maharashtra'){
	foreach ($data['districtData'] as $Distdata) {
	$totalcasesinMaharastra=$totalcasesinMaharastra+$Distdata['confirmed'];
	}
}

if($data['state']=='Delhi'){
	foreach ($data['districtData'] as $Distdata) {
	$totalcasesinDelhi=$totalcasesinDelhi+$Distdata['confirmed'];
	}
}

if($data['state']=='Rajasthan'){
	foreach ($data['districtData'] as $Distdata) {
	$totalcasesinRajasthan=$totalcasesinRajasthan+$Distdata['confirmed'];
	}
}

if($data['state']=='Gujarat'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinGujarat=$totalinGujarat+$Distdata['confirmed'];
	}
}
if($data['state']=='Tamil Nadu'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinTamilNadu=$totalinTamilNadu+$Distdata['confirmed'];
	}
}
if($data['state']=='Madhya Pradesh'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinMP=$totalinMP+$Distdata['confirmed'];
	}
}

if($data['state']=='Telangana'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinTel=$totalinTel+$Distdata['confirmed'];
	}
}
if($data['state']=='Andhra Pradesh'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinAndhraP=$totalinAndhraP+$Distdata['confirmed'];
	}
}
if($data['state']=='Kerala'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinKerala=$totalinKerala+$Distdata['confirmed'];
	}
}
if($data['state']=='Karnataka'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinKarnataka=$totalinKarnataka+$Distdata['confirmed'];
	}
}

if($data['state']=='Jammu and Kashmir'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinJK=$totalinJK+$Distdata['confirmed'];
	}
}
if($data['state']=='West Bengal'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinWB=$totalinWB+$Distdata['confirmed'];
	}
}
if($data['state']=='Haryana'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinHaryana=$totalinHaryana+$Distdata['confirmed'];
	}
}
if($data['state']=='Punjab'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinPunjab=$totalinPunjab+$Distdata['confirmed'];
	}
}
if($data['state']=='Bihar'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinBihar=$totalinBihar+$Distdata['confirmed'];
	}
}

if($data['state']=='Odisha'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinOdisa=$totalinOdisa+$Distdata['confirmed'];
	}
}

if($data['state']=='Uttarakhand'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinUK=$totalinUK+$Distdata['confirmed'];
	}
}
if($data['state']=='Jharkhand'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinJharkhand=$totalinJharkhand+$Distdata['confirmed'];
	}
}

if($data['state']=='Himachal Pradesh'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinHP=$totalinHP+$Distdata['confirmed'];
	}
}
if($data['state']=='Chhattisgarh'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinChattis=$totalinChattis+$Distdata['confirmed'];
	}
}
if($data['state']=='Ladakh'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinLadakh=$totalinLadakh+$Distdata['confirmed'];
	}
}
if($data['state']=='Goa'){
	foreach ($data['districtData'] as $Distdata) {
	$totalinGoa=$totalinGoa+$Distdata['confirmed'];
	}
}



}

// End Logic for Calculating State Counting

$totalcasesinlko=0;
foreach ($user_data as $data) {
	if($data['state']=='Uttar Pradesh')
foreach ($data['districtData'] as $Distdata) {
	if($Distdata['district']=='Lucknow')
$totalcasesinlko=$totalcasesinlko+$Distdata['confirmed'];
}
}

?>
	<div class="main-section">
		<div class="dashbord">
			<div class="icon-section">
				<i class="fa fa-users" aria-hidden="true"></i><br>
				<small>Total Cases in India</small>
				<p><?php echo $totalcases; ?></p>
			</div>
			
		</div>
			<div class="dashbord">
			<div class="icon-section">
				<i class="fa fa-users" aria-hidden="true"></i><br>
				<small>Total Cases in Uttar Pradesh</small>
				<p><?php echo $totalcasesinup; ?></p>
			</div>
			
		</div>
		<div class="dashbord">
			<div class="icon-section">
				<i class="fa fa-users" aria-hidden="true"></i><br>
				<small>Total Cases in Lucknow</small>
				<p><?php echo $totalcasesinlko; ?></p>
			</div>
			
		</div>
			
		
	</div>
	
	<br><center><h1 style="font-family:Century Gothic;">State Wise Tally</h1></center><br>
	<div class="aa">
	    <h3 style="text-align:center;">State | Cases</h3>
	    
	</div>

	
<?php
       
foreach ($user_data as $data) {
	if($data['state']=='Uttar Pradesh')
	echo '<button  class="accordion">'.$data['state'] .'<span>  :</span>&nbsp; '.$totalcasesinup . '</span></button>';

if($data['state']=='Maharashtra')
	echo '<button style="background-color:#fff;color:#000;" id="1" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalcasesinMaharastra . '</button>';
if($data['state']=='Delhi')
	echo '<button style="background-color:#fff;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalcasesinDelhi . '</button>';
if($data['state']=='Rajasthan')
	echo '<button style="background-color:#fff;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalcasesinRajasthan . '</button>';
if($data['state']=='Gujarat')
	echo '<button style="background-color:#fff;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinGujarat . '</button>';
if($data['state']=='Tamil Nadu')
	echo '<button style="background-color:#fff;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinTamilNadu . '</button>';
if($data['state']=='Madhya Pradesh')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinMP . '</button>';
if($data['state']=='Telangana')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinTel . '</button>';
if($data['state']=='Andhra Pradesh')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinAndhraP . '</button>';
if($data['state']=='Kerala')
	echo '<button style="background-color:#fff;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinKerala . '</button>';
if($data['state']=='Karnataka')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinKarnataka . '</button>';
if($data['state']=='Jammu and Kashmir')
	echo '<button style="background-color:#fff;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinJK . '</button>';
if($data['state']=='West Bengal')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinWB . '</button>';
if($data['state']=='Haryana')
	echo '<button style="background-color:#fff;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinHaryana . '</button>';
if($data['state']=='Punjab')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinPunjab . '</button>';
if($data['state']=='Bihar')
	echo '<button style="background-color:#fff;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinBihar . '</button>';
if($data['state']=='Odisha')
	echo '<button style="background-color:#fff;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinOdisa . '</button>';
if($data['state']=='Uttarakhand')
	echo '<button style="background-color:#fff;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinUK . '</button>';
if($data['state']=='Jharkhand')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinJharkhand . '</button>';
if($data['state']=='Himachal Pradesh')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinHP . '</button>';
if($data['state']=='Chhattisgarh')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinChattis . '</button>';
if($data['state']=='Ladakh')
	echo '<button class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinLadakh . '</button>';
if($data['state']=='Goa')
	echo '<button style="border-radius:10px;color:#000;" class="accordion">'.$data['state'] .'<span>  :</span>&nbsp;'.$totalinGoa . '</button>';
					
					
					
	
	?>
	<div class="panel"><p>
	  <table class="w3-table-all w3-hoverable">

	<?php
	foreach ($data['districtData'] as $Distdata) {
		echo ' <tr class="w3-light-grey"><td>'.$Distdata['district'].'</td><td>'.$Distdata['confirmed'].'</td></tr>';
	}
	
	?>
	  </table>
	</p></div>
	<?php
}

?>



<hr style="margin-top:50px;width:100%;border-radius:5px;border-width:5px;">




<!--footer2-->

<footer class="footer-distributed">
 
		<div class="footer-left">
 
		<h3>Blogs<span> by Pratimesh Tiwari</span></h3>
 
		<p class="footer-links">
	·	<a href="https://pratimeshtiwari.com">Home</a><br>
	·
		<a href="https://pratimeshtiwari.com/blog">Blog</a><br>
	·
		<a href="https://officialipl.in">IPL news</a><br>
	·
		<a href="https://pratimeshtiwari.com/contact">Contact</a>
	

		</p>
 
		
		</div>
 
		<div class="footer-center">
 
		<div>
		<i class="fa fa-map-marker"></i>
		<p><span>127.0.0.1</span>Mars</p>
		</div>
 
		<br>
 
		<div>
		<i class="fa fa-envelope"></i>
		<p><a href="mailto:support@pratimeshtiwari.com">support@pratimeshtiwari.com</a></p>
		</div>
		<br>
		<div>
		<i class="fa fa-envelope"></i>
		<p><a href="mailto:notify@pratimeshtiwari.com">notify@pratimeshtiwari.com</a></p>
		</div>
 
		</div>
 
		<div class="footer-right">
 
		<p class="footer-company-about">
		<span>About</span>Documenting my coding journey from stratch &amp; writing blogs and spreading knowledge on the globe.
		</p>
 
		<div class="footer-icons">
 
	<!--	<a href="#"><i class="fab fa-facebook-f"></i></a>
		<a href="#"><i class="fab fa-twitter"></i></a>
		<a href="#"><i class="fab fa-linkedin"></i></a>-->
		<a href="https://github.com/PratimeshTiwari"><i class="fab fa-github"></i></a>
 
		</div>
 
		</div>
		
		<center><p  style="font-size:16px" class="footer-company-name"> &copy; 2021.<br>Developed by <b>Ashish Tiwari& <b>Pratimesh Tiwari</b></p></center>
 
		</footer>
      


<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

/* Toggle between showing and hiding the navigation menu links when the user clicks on the hamburger menu / bar icon */
function myFunction() {
  var x = document.getElementById("myLinks");
  if (x.style.display === "block") {
    x.style.display = "none";
  } else {
    x.style.display = "block";
  }
}
</script>
<!-- JS here -->

		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>

		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>

		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

		<!-- Jquery Plugins, main Jquery -->
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>

</body>
</html>
