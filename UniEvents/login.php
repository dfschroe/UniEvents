<?php

require 'config.php';

if( isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

	header('Location: home.php');
}
else {

	if( isset($_POST['email']) && isset($_POST['password']) ){
		
		if( empty($_POST['email']) || empty($_POST['password']) ) {


			$error = "Please enter a email and password ";
		}
		
		else {
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			$emailInput = $_POST["email"];
			
			$passwordInput = hash("sha256",$_POST["password"]);

		
			$sql = "SELECT * FROM profiles
			WHERE email = '" . $emailInput . "' AND password= '". $passwordInput."';";
			

			
			$results = $mysqli->query($sql);
			if(!$results){
				echo $mysqli->error;
				exit();
			}
			if($results->num_rows > 0){
			$_SESSION['logged_in'] = true;
			while($row=$results->fetch_assoc()){
			$_SESSION['firstname'] = $row["firstname"];
			$_SESSION['id']=$row["id"];
			$_SESSION['lastname']=$row["lastname"];
			$_SESSION['events_organized']=$row["events_organized"];
			$_SESSION['university']=$row["university_id"];
			}
			
			header('Location: ./home.php');
			}
			else {
			$error = "Invalid email or password";
			}
	}
}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - UniEvents</title>
	<link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php include 'nav.php'; ?>
<div class="container" id="login-container">
			<h1 class="brand-yellow">Login</h1>
			<form action="login.php" method="POST">
				<div class="row mb-3">
				<div class="font-italic text-danger col-sm-9">
					<?php
						if ( isset($error) && !empty($error) ) {
							echo $error;
						}
					?>
				</div>
			</div>
				<div class="form-group">
					<input type="text" class="form-control" id="email-id" name="email" placeholder="email">
					<small id="email-error" class="invalid-feedback">Email is required.</small>
				</div>
			

			
				<div class="form-group">
					<input class="form-control" type="password" id="password-id" name="password" placeholder="password">
					<small id="password-error" class="invalid-feedback">Password is required.</small>
			</div> 
					<button type="submit" class="btn btn-primary">Login</button>
				
		</form>
				<a href="signup.php" id="signup-button">Sign Up</a>
<script>
			
	document.querySelector('form').onsubmit = function(){
	if ( document.querySelector('#email-id').value.trim().length == 0 ) {
		document.querySelector('#email-id').classList.add('is-invalid');
	} else {
		document.querySelector('#email-id').classList.remove('is-invalid');
	}

	if ( document.querySelector('#password-id').value.trim().length == 0 ) {
		document.querySelector('#password-id').classList.add('is-invalid');
	} else {
		document.querySelector('#password-id').classList.remove('is-invalid');
	}
	return ( !document.querySelectorAll('.is-invalid').length > 0 );
}
</script>

</div>
</body>
</html>