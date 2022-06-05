<?php 
print '
	<head>
	<title>Preporuke knjiga</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Marija Jurić">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="style.css">
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href="http://fonts.googleapis.com/css?family=Dancing+Script|Open+Sans+Condensed:300" rel="stylesheet" type="text/css" />
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<div id="wrapper">
	<div id="menu-wrapper">
		
	</div>
	<div id="logo" class="container">
		<h1><a href="index.php">Preporuke knjiga </a></h1>
	</div>
	<div class="divider">&nbsp;</div>

	<h2 style=centar>Prijava</h2>

	</div>
	';
	if ($_SESSION['user']['valid'] == 'true') {
		if (!isset($action)) { $action = 1; }
		print '
		<div id="admin">
			<ul>
				<li><a href="index.php?menu=7&amp;action=1">Korisnici</a></li>
			</ul>';
			# Admin Users
			if ($action == 1) { include("admin/users.php"); }
					
			
		print '
		</div>';
	}
	else {
		$_SESSION['message'] = '<p>Molim vas da se prijavite ili registrirate!</p>';
		header("Location: index.php?menu=6");
	}
?>