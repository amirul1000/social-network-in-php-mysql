<!doctype html>



<html lang="en">







<head>



<meta charset="utf-8" />



<title>Enforcement</title>







<link rel="stylesheet" href="../css/layout.css" type="text/css"

	media="screen" />



<!--[if lt IE 9]>



	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />



	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>



	<![endif]-->



<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>



<script src="../js/hideshow.js" type="text/javascript"></script>











<script type="text/javascript">



	



	$(document).ready(function() {







	//When page loads...



	$(".tab_content").hide(); //Hide all content



	$("ul.tabs li:first").addClass("active").show(); //Activate first tab



	$(".tab_content:first").show(); //Show first tab content







	//On Click Event



	$("ul.tabs li").click(function() {







		$("ul.tabs li").removeClass("active"); //Remove any "active" class



		$(this).addClass("active"); //Add "active" class to selected tab



		$(".tab_content").hide(); //Hide all tab content







		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content



		$(activeTab).fadeIn(); //Fade in the active ID content



		return false;



	});







});



    </script>











</head>











<body>




	<div id="header" >

 

			<h1 class="site_title"  style="width:3253px; height:97px; background:#313640">



				<a href="#" style="color:#FFF;">Enforcement</a>



			</h1>



			<h2 class="section_title"></h2>



			 
 

	</div>



	<!-- end of header bar -->















	<section id="main" class="column">



		<?php 	include("../template/left_menu.php");?>



		</article>



		<!-- end of stats article -->







		<article class="module width_3_quarter">
 
		 


			<div class="tab_container" style="width:2950px; ">



				<div id="tab1" class="tab_content"> 