<?php
require 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if(!isset($_GET['event_id']) || empty($_GET['event_id'])){
	  header('Location: home.php');
}
else{
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
$organizersql = "SELECT * FROM profiles WHERE id=" . $organizer . ";";
$organizerresults=$mysqli->query($organizersql);
if(!$organizerresults){
	echo $mysqli->error;
	exit();
}
while($row=$organizerresults->fetch_assoc()){
	$organizerimage=$row["photo_path"];
	$organizerfirstname= $row["firstname"];
	$organizerlastname= $row["lastname"];
}
$universitysql = "SELECT * FROM universities WHERE id=" . $university . ";";
$universityresults=$mysqli->query($universitysql);
if(!$universityresults){
	echo $mysqli->error;
	exit();
}
while($row=$universityresults->fetch_assoc()){
	$university = $row["name"];
	}
}
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cabaret - UniEvents</title>
	<link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
    	#event-jumbo{
    		background-image:url("event_images/<?php echo $image;?>");
    	}
    </style>
</head>
<body>
<?php include 'nav.php'; ?>

<div class="jumbotron" id="event-jumbo">
	<h1><?php echo $event_name; ?></h1>
	<h3><?php echo $location; ?> • <?php echo date('F j, Y',strtotime($date));?> </h3>
</div>
<div class="container-fluid" id="event-info">
	<div class="row">
	<div class="col-10 text-center">
	<div id="organizer" >
		<a href="profile.php?name=<?php echo $organizerfirstname . '_'.$organizerlastname;?>"><h3><img src="profile_images/<?php echo $organizerimage;?>">Organized By <?php echo $organizerfirstname . " ". $organizerlastname;?> at <div class="brand"><?php echo $university; ?></div> </h3></a>
	</div>
	<div id="event-properties">
	<h3><span class="weak"><?php echo $description;?></span></h3>
	<?php if (isset($_SESSION['logged_in']) && $_SESSION["logged_in"] && $organizer==$_SESSION["id"]): ?>
			<div class="text-center">
	 	<a href="edit_event.php?event_id=<?php echo $_GET['event_id'];?>"><button class="btn btn-primary" id="edit-event">Edit Event</button></a> 
	</div>
	<?php endif;?>
</div>
</div>
</div>
</div>
</body>
</html>