<?php
require 'config.php';
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Event - UniEvents</title>
	<link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php include 'nav.php'; ?>
<p class="text-success text-center">Logged Out</p>
<div class="text-center" >
	<a href="home.php"><button class="btn btn-primary mx-auto" id="Home">Home</button></a>
</div>

</body>
</html>