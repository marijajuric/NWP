<?php 

define('__APP__', TRUE);
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	# Start session
    session_start();
	
	# Database connection
	include ("dbconn.php");
	
	# Variables MUST BE INTEGERS
    if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }
	if(isset($_GET['action'])) { $action   = (int)$_GET['action']; }
	
	# Variables MUST BE STRINGS A-Z
    if(!isset($_POST['_action_']))  { $_POST['_action_'] = FALSE;  }
	
	if (!isset($menu)) { $menu = 1; }
	
	# Classes & Functions
    include_once("functions.php");

    print '
<body>
	<header>
		<div'; if ($menu > 1) { print ' class="hero-subimage"'; } else { print ' class="hero-image"'; }  print '></div>
		<nav>';
			include("menu.php");
		print '</nav>
	</header>
	<main>';

	
	if (isset($_SESSION['message'])) {
			print $_SESSION['message'];
			unset($_SESSION['message']);
		}
	
	# Homepage
	if (!isset($menu) || $menu == 1) { include("home.php"); }
	
	# New books
	else if ($menu == 2) { include("preporuke.php"); }
		
	# About us
	else if ($menu == 3) { include("o_nama.php"); }

	else if ($menu == 4) { include("citati.php"); }
	# Contact
	else if ($menu == 5) { include("kontakt.php"); }
	
	# Register
	else if ($menu == 6) { include("register.php"); }
	
	# Signin
	else if ($menu == 7) { include("signin.php"); }
	
	# Admin webpage
	else if ($menu == 8) { include("admin.php"); }

	else if ($menu == 9) { include("12pravila.php"); }
	
	# API OMDB
	else if ($menu == 10) { include("omdb.php"); }


	else if ($menu == 15) { include("send.php"); }
	

	print '

<div id="footer">
	<p>Društvene mreže:<br> 
			<a href="https://www.linkedin.com/" target="_blank"><img src="img/linkedin.svg" alt="Linkedin" title="Linkedin" style="width:20px; margin-top:0.4em"></a>
			<a href="https://twitter.com/" target="_blank"><img src="img/twitter.svg" alt="Twitter" title="Twitter" style="width:20px; margin-top:0.4em"></a>
			<a href="https://facebook.com" target="_blank"><img src="img/facebook.svg" alt="Facebook" title="Facebook" style="width:24px; margin-top:0.4em"></a>
			<p>Copyright &copy; ' . date("Y") . ' Marija Jurić <a href="https://github.com/marijajuric" target="_blank"><img src="img/github.png" title="Github" alt="Github"></a></p>
</div>

</body>
';
?>
