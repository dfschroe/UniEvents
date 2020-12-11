<?php
require 'config.php';
if( !isset($_SESSION['logged_in']) && !$_SESSION['logged_in']) {

    header('Location: home.php');
}
else{
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	$sql ="SELECT * FROM events WHERE id=". $_GET['event_id'] . ";";
	$results=$mysqli->query($sql);
	if(!$results){
	echo $mysqli->error;
	exit();
}
	while($row=$results->fetch_assoc()){
		$image=$row["photo_path"];
		$event_name=$row["name"];
		$location=$row["location"];
		$organizer=$row["organizer"];
		$date = $row["date"];
		$description=$row["description"];
		$university=$row["university_id"];
	}
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

	<div class="container">

		<form action="edit_confirmation.php" method="POST" enctype="multipart/form-data">

			<div class="row">
				
					<label for="event-title-id" class="col-sm-3 text-sm-right col-form-label">Event Title: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="event-title-id" name="event-title" value="<?php echo $event_name;?>">
					<small id="title-error" class="invalid-feedback">Event Title is required.</small>
				</div>
			</div> 

			<div class="row">
				<label for="date-id" class="col-sm-3 text-sm-right form-label" >Date: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="date" class="form-control" id="date-id" name="date" value=<?php echo $date;?>>
					<small id="date-error" class="invalid-feedback">Date is required.</small>
					</div>
			</div>
			<div class="row">
				<label for="description-id" class="col-sm-3 form-label text-sm-right">Description: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="description-id" name="description" value="<?php echo $description;?>">
					<small id="description-error" class="invalid-feedback">Description is required.</small>
					</div>
			</div> 
			<div class="row">
				<label for="location-id" class="col-sm-3 form-label text-sm-right">Location: <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="location-id" name="location" value="<?php echo $location;?>">
					<small id="location-error" class="invalid-feedback">Location is required.</small>
					</div>
			</div> 
			<div class="row">
				<label for="picture-id" class="col-sm-3 form-label text-sm-right">Picture(if you wish to change it): <span class="text-danger">*</span></label>
				<div class="col-sm-9">
					   <input type="file" name="picture" id="picture-id" accept="image/png, image/jpg, image/jpeg" >
					  
					</div>
			</div> 

			<div class="row">
					<div class="col-md-2 mx-auto">
					<span class="text-danger font-italic">* Required</span>
				</div>
			</div>

			<div class="row">
				<div class="col-md-2 mx-auto">
					<button type="submit" class="btn btn-primary">Edit Event</button>
					</div>

			</div> 
<input type="hidden" name="event_id" value="<?php echo $_GET['event_id']?>">
		</form>
	</div> 
<script>
			
			document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#event-title-id').value.trim().length == 0 ) {
				document.querySelector('#event-title-id').classList.add('is-invalid');
			} else {
				document.querySelector('#event-title-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#date-id').value.trim().length == 0 ) {
				document.querySelector('#date-id').classList.add('is-invalid');
			} else {
				document.querySelector('#date-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#description-id').value.trim().length == 0 ) {
				document.querySelector('#description-id').classList.add('is-invalid');
			} else {
				document.querySelector('#description-id').classList.remove('is-invalid');
			}
			if ( document.querySelector('#location-id').value.trim().length == 0 ) {
				document.querySelector('#location-id').classList.add('is-invalid');
			} else {
				document.querySelector('#location-id').classList.remove('is-invalid');
			}
			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>