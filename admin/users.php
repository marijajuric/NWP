<?php 
	
	# Update user profile
	if (isset($_POST['edit']) && $_POST['_action_'] == 'TRUE') {
		$query  = "UPDATE users SET firstname='" . $_POST['firstname'] . "', lastname='" . $_POST['lastname'] . "', email='" . $_POST['email'] . "', username='" . $_POST['username'] . "', country='" . $_POST['country'] . "', archive='" . $_POST['archive'] . "'";
        $query .= " WHERE id=" . (int)$_POST['edit'];
        $query .= " LIMIT 1";
        $result = @mysqli_query($MySQL, $query);
		# Close MySQL connection
		@mysqli_close($MySQL);
		
		$_SESSION['message'] = '<p>Uspjesno ste izmjenili korisnicki profil!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=1");
	}
	# End update user profile
	
	# Delete user profile
	if (isset($_GET['delete']) && $_GET['delete'] != '') {
	
		$query  = "DELETE FROM users";
		$query .= " WHERE id=".(int)$_GET['delete'];
		$query .= " LIMIT 1";
		$result = @mysqli_query($MySQL, $query);

		$_SESSION['message'] = '<p>Uspješno ste obrisali korisnicki profil!!</p>';
		
		# Redirect
		header("Location: index.php?menu=7&action=1");
	}
	# End delete user profile
	
	
	#Show user info
	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['id'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		print '
		<div class="container"><h2>Korinsički profil</h2></div>
		<br/>
		<div class="container"><p><b>Ime:</b> ' . $row['firstname'] . '</p></div>
		<div class="container"><p><b>Prezime:</b> ' . $row['lastname'] . '</p></div>
		<div class="container"><p><b>Korisnicko ime:</b> ' . $row['username'] . '</p></div>';
		$_query  = "SELECT * FROM countries";
		$_query .= " WHERE country_code='" . $row['country'] . "'";
		$_result = @mysqli_query($MySQL, $_query);
		$_row = @mysqli_fetch_array($_result);
		print '
		<div class="container"><p><b>Država:</b> ' .$_row['country_name'] . '</p></div>
		<div class="container"><p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Nazad</a></p></div>';
	}
	#Edit user profile
	else if (isset($_GET['edit']) && $_GET['edit'] != '') {
		$query  = "SELECT * FROM users";
		$query .= " WHERE id=".$_GET['edit'];
		$result = @mysqli_query($MySQL, $query);
		$row = @mysqli_fetch_array($result);
		$checked_archive = false;
		
		print '
		<h2>Uredi profil</h2>
		<div class="container">
		<form action="" id="registration_form" name="registration_form" method="POST">
			<input type="hidden" id="_action_" name="_action_" value="TRUE">
			<input type="hidden" id="edit" name="edit" value="' . $_GET['edit'] . '">
			
			<label for="fname">Ime *</label>
			<br/>
			<input type="text" id="fname" name="firstname" value="' . $row['firstname'] . '" placeholder="Your name.." required>
			<br/>

			<label for="lname">Prezime *</label>
			<br/>
			<input type="text" id="lname" name="lastname" value="' . $row['lastname'] . '" placeholder="Your last natme.." required>
			<br/>
				
			<label for="email">E-mail *</label>
			<br/>
			<input type="email" id="email" name="email"  value="' . $row['email'] . '" placeholder="Your e-mail.." required>
			<br/>
			
			<label for="username">Korisnicko ime *<small>(Username must have min 5 and max 10 char)</small></label>
			<br/>
			<input type="text" id="username" name="username" value="' . $row['username'] . '" pattern=".{5,10}" placeholder="Username.." required><br>
			
			
			<label for="country">Zemlja</label>
			<br/>
			<select name="country" id="country">
				<option value="">molimo odaberite</option>
				<br/>';
				#Select all countries from database webprog, table countries
				$_query  = "SELECT * FROM countries";
				$_result = @mysqli_query($MySQL, $_query);
				while($_row = @mysqli_fetch_array($_result)) {
					print '<option value="' . $_row['country_code'] . '"';
					if ($row['country'] == $_row['country_code']) { print ' selected'; }
					print '>' . $_row['country_name'] . '</option>';
				}
			print '
			</select>
			<br/>
			<label for="archive">Archive:</label><br />
            <input type="radio" name="archive" value="Y"'; if($row['archive'] == 'Y') { echo ' checked="checked"'; $checked_archive = true; } echo ' /> YES &nbsp;&nbsp;
			<input type="radio" name="archive" value="N"'; if($checked_archive == false) { echo ' checked="checked"'; } echo ' /> NO
			
			<hr>
			
			<input type="submit" value="Potvrdi">
		</form>
		</div>
		<div class="container"><p><a href="index.php?menu='.$menu.'&amp;action='.$action.'">Nazad</a></p></div>';
	}
	else {
		print '
		<div class="container"><h2>Popis korisnika</h2></div>
		<div id="users">
			<table>
				<thead>
					<tr class="container">
						<th width="40"></th>
						<th width="40"></th>
						<th width="40"></th>
						<th width="40">Ime</th>
						<th width="40">Prezime</th>
						<th width="40">E mail</th>
						<th width="40">Država</th>
						<th width="40">Status</th>
					</tr>
				</thead>
				<tbody>';
				$query  = "SELECT * FROM users";
				$result = @mysqli_query($MySQL, $query);
				while($row = @mysqli_fetch_array($result)) {
					print '
					<tr>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;id=' .$row['id']. '"><img src="img/user.png" alt="user" ></a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;edit=' .$row['id']. '"><img src="img/edit.png" alt="edit"></a></td>
						<td><a href="index.php?menu='.$menu.'&amp;action='.$action.'&amp;delete=' .$row['id']. '"><img src="img/delete.png" alt="delete"></a></td>
						<td><strong>' . $row['firstname'] . '</strong></td>
						<td><strong>' . $row['lastname'] . '</strong></td>
						<td>' . $row['email'] . '</td>
						<td>';
							$_query  = "SELECT * FROM countries";
							$_query .= " WHERE country_code='" . $row['country'] . "'";
							$_result = @mysqli_query($MySQL, $_query);
							$_row = @mysqli_fetch_array($_result, MYSQLI_ASSOC);
							print $_row['country_name'] . '
						</td>
						<td>';
							if ($row['archive'] == 'Y') { print '<img src="img/inactive.png" alt="archive" title="" />'; }
                            else if ($row['archive'] == 'N') { print '<img src="img/active.png" alt="active" title="" />'; }
						print '
						</td>
					</tr>';
				}
			print '
				</tbody>
			</table>
		</div>';
	}
	
	# Close MySQL connection
	@mysqli_close($MySQL);
?>