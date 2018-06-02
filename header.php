<?php
session_start();
error_reporting(E_ERROR);

?>
<html>
	<head>
		<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>Thesis Tracking System for UPM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/style.css" type="text/css" rel="stylesheet">
	<script src="js/gen_validatorv31.js" type="text/javascript"></script>
	
  </head>
  




  <body>
  	<header style="padding-top:0;margin-top:0;width:99%;background-image:url('images/banner.png');height:180px;color:red" align="center">
	
		<h1 style="font-size:42px;padding-top:44px">THESIS TRACKING SYSTEM FOR University</h1>
	</header>
    
    <header align="center">
		<nav>
		  <ul class="nav inline-items top-level-menu" >
			<li class=""><a href="index.php">Home</a></li>
			<li class=""><a href="contact.php">Contact US</a></li>
			<li class=""><a href="about.php">About Us</a></li>
			<li class=""><a href="faq.php">FAQ</a></li>
			<?php if(isset($_SESSION['id'])){ ?>
			<li class=""><a href="announcement.php">Announcements</a></li>
			<?php }else{ ?>
			<li class="">
				<a href="">Student Portal</a>
				<ul class="second-level-menu">
					<li><a href="studentLogin.php">Student Login</a></li>
					<li><a href="studentReg.php">SignUp</a></li>
            
				</ul>
			</li>
			<li class="">
				<a href="">Lecturer Portal</a>
				<ul class="second-level-menu">
					<li><a href="lecturerLogin.php">Lecturer Login</a></li>
					<li><a href="lecturerReg.php">SignUp</a></li>
					
				</ul>
			</li>
			<?php } ?>
		  </ul>
		</nav>
       
    </header>
	
	<header style="padding:0">
		<table style="width:100%">
			<tr>
				<td><img src="images/img1.jpg" height="220" width="180"></td>
				<td><img src="images/img2.jpg" height="220" width="180"></td>
				<td><img src="images/img3.jpg" height="220" width="180"></td>
				<td><img src="images/img4.jpg" height="220" width="180"></td>
			</tr>
		</table>
	</header>
	
	
	  
<!-- <SCRIPT>
    document.getElementById('tr').style.display='NONE';    
</SCRIPT>
-->