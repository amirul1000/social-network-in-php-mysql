<!doctype html>



<html lang="en">







<head>



<meta charset="utf-8" />



<title>linkotopia</title>







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







	<header id="header">



		<hgroup>



			<h1 class="site_title">



				<a href="#">linkotopia</a>



			</h1>



			<h2 class="section_title"></h2>



			<div class="btn_view_site">



				<a href="/"></a>



			</div>



		</hgroup>



	</header>



	<!-- end of header bar -->















	<section id="main" class="column">



		<?php 	include("../template/left_menu.php");?>



		</article>



		<!-- end of stats article -->







		<article class="module width_3_quarter">



			<header>



				<h3 class="tabs_involved"></h3>







			</header>







			<div class="tab_container">



				<div id="tab1" class="tab_content">