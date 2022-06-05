<?php 
	print '
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
	
	<main>
		<div id="article">
		<h1>Kontakt</h1>
		<div id="contact">

			<iframe src="https://maps.google.com/maps?q=Velika%20Gorica&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>

		</div>
		<div class="container">
	<form method="POST" action="send.php">
		<div><label>Ime:</label></div>
		<div><input type="text" name="ime" class="form-control" /></div>
		<div><label>Prezime:</label></div>
		<div><input type="text" name="prezime" class="form-control" /></div>
		<div><label>Email:</label></div>
		<div><input type="text" name="myEmail" class="form-control" /></div>
		
		<div><label>Poruka:</label></div>
		<div><textarea cols="40" rows="5" name="myMessage" class="form-control"></textarea></div>
		<div class="float-right mt-2">
			<input type="submit" value="Send" class="btn btn-primary" />
		</div>
	</form>

</div>
	</main>
	
	
</body>
';
?>
