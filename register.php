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

	<h1 style=centar>Registracija korisnika</h1>
	<div id="register">';
	
	if ($_POST['_action_'] == FALSE) {
		print '
		<div class="container">
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">

			<div><label>Ime:</label></div>
			<div><input type="text" id="fname" name="firstname" placeholder="Unesi ime.." required></div>

			<br/>
			
			<div><label>Prezime:</label></div>
			<div><input type="text" id="lname" name="lastname" placeholder="Unesi prezime.." required></div>
			<br/>
			
			<div><label>email:</label></div>
			<div><input type="email" id="email" name="email" placeholder="Unesi e-mail.." required></div>
			<br/>
				
			<div><label for="username">Korisnicko ime * <small>(Korisnicko ime mora sadržavati min 5 i max 10 znakova)</small></label></div>
			<div><input type="text" id="username" name="username" pattern=".{5,10}" placeholder="Korisnicko ime.." required></div>	
			<br/>	

			<div><label for="password">Lozinka * <small>(Lozinka mora sadržavati min 4 znaka)</small></label></div>
			<div><input type="password" id="password" name="password" placeholder="Lozinka.." pattern=".{4,}" required></div>	
			<br/>		
					

			<div><label for="country">Zemlja </label></div>
			<select name="country" id="country">
				<option value="">molimo odaberite</option>
				</body>';
				#Select all countries from database webprog, table countries
				$query  = "SELECT * FROM countries";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
				}
			print '
			</select>

			<br/>
			<br/>
			<input type="submit" value="Potvrdi">
		</form>
		</div>
		</div>
		';
	}
	else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT count(*) as count FROM users";
		$query .= " WHERE email='" .  $_POST['email'] . "'";
		$query .= " OR username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
		
		if ((int)$row['count'] == 0) {
			# password_hash https://secure.php.net/manual/en/function.password-hash.php
			# password_hash() creates a new password hash using a strong one-way hashing algorithm
			$pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
			
			$query  = "INSERT INTO users (firstname, lastname, email, username, password, country)";
			$query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "')";
			$result = @mysqli_query($MySQL, $query);
			
			# ucfirst() — Make a string's first character uppercase
			# strtolower() - Make a string lowercase
			echo '<p>' . ucfirst(strtolower($_POST['firstname'])) . ' ' .  ucfirst(strtolower($_POST['lastname'])) . ', hvala na registraciji! </p>
			<hr>';
		}
		else {
			echo '<p>Korisnik s ovim korisičkim imenom već postoji!</p>';
		}
	}
	print '
	
	</div>';
?>