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

	<div id="signin">
	';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<div class="container">
		<form action="" name="myForm" id="myForm" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<br/>

			<div><label for="username">Korisnicko ime*</label></div>
			<div><input type="text" id="username" name="username" value="" pattern=".{5,10}" required></div>

			<br/>						
			<div><label for="password">Lozinka *</label></div>
			<div><input type="password" id="password" name="password" value="" pattern=".{4,}" required></div>
			<br/>
									
			<input type="submit" value="Potvrdi">
		</form>
		
		';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if (password_verify($_POST['password'], $row['password'])) {
			#password_verify https://secure.php.net/manual/en/function.password-verify.php
			$_SESSION['user']['valid'] = 'true';
			$_SESSION['user']['id'] = $row['id'];
			$_SESSION['user']['firstname'] = $row['firstname'];
			$_SESSION['user']['lastname'] = $row['lastname'];
			$_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>';
			# Redirect to admin website
			header("Location: index.php?menu=7");
		}
		
		# Bad username or password
		else {
			unset($_SESSION['user']);
			$_SESSION['message'] = '<p style=container>Pogrešno korisničko ime ili lozinka!</p>';
			header("Location: index.php?menu=6");
		}
	}
	print '
	</div>';
?>