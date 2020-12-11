<?php
if ( !isset($_POST['event-title']) || 
	empty($_POST['event-title']) || 
	!isset($_POST['date']) || 
	empty($_POST['date']) || 
	!isset($_POST['description']) || 
	empty($_POST['description']) || 
	!isset($_POST['location']) || 
	empty($_POST['location']) ) {

	$error = "Please fill out all required fields.";
}
else{
	require 'config.php';
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	$target_dir ="event_images/";
	$target_file = $target_dir . basename($_FILES["picture"]["name"]);
	move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);
	if(isset($_FILES["picture"]["tmp_name"]) && !empty($_FILES["picture"]["tmp_name"])){
		$sql_prepared="UPDATE events SET name=?, location=?, organizer=?, description=?, date=?, university_id=?, photo_path=? WHERE id=". $_POST['event_id'].";";
		$statement = $mysqli->prepare($sql_prepared);
		$statement->bind_param("ssissis", $_POST["event-title"], $_POST["location"], $_SESSION["id"], $_POST["description"],$_POST["date"], $_SESSION["university"], $_FILES["picture"]["name"]);
	}
	else{
		$sql_prepared="UPDATE events SET name=?, location=?, organizer=?, description=?, date=?, university_id=? WHERE id=". $_POST['event_id'].";";
		$statement = $mysqli->prepare($sql_prepared);
		$statement->bind_param("ssissi", $_POST["event-title"], $_POST["location"], $_SESSION["id"], $_POST["description"],$_POST["date"], $_SESSION["university"]);
	}
	$executed=$statement->execute();
	if(!$executed) {
			echo $mysqli->error;
		}

	$mysqli->close();
}
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
<div class="container">
		<div class="row">
			<h1 class="brand-yellow header">Edit Event</h1>
		</div> 
	</div> 
<p class="text-success text-center">Event Successfully Created</p>
<div class="text-center" >
	<a href="event.php?event_id=<?php echo $_POST['event_id'];?>"><button class="btn btn-primary mx-auto" id="view-event">View Event</button></a>
</div>

</body>
</html>