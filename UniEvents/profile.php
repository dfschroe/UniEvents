<?php
require 'config.php';
if(isset($_GET["name"])){
list($firstname, $lastname) = explode("_",$_GET["name"]);

 $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if($mysqli->connect_errno) {
    echo $mysqli->connect_error;
    exit();
  }

$profsql = "SELECT * FROM profiles WHERE firstname='" . $firstname. " ' AND lastname='". $lastname . "';";

$profresults = $mysqli->query($profsql);
  if(!$profresults){
    echo $mysqli->error;
    exit();
  }

while($row=$profresults->fetch_assoc()){
	$id=$row["id"];
	$photo_path=$row["photo_path"];
	$events=$row["events_organized"];
	$university=$row["university_id"];
}
$unisql = "SELECT * FROM universities WHERE id=". $university. ";";
$uniresults= $mysqli->query($unisql);
if(!$uniresults){
    echo $mysqli->error;
    exit();
  }
while($row=$uniresults->fetch_assoc()){
	$university=$row["name"];
}
if($events!=""){
$eventsql = "SELECT * FROM events WHERE id IN(". $events.");";
$eventresults = $mysqli->query($eventsql);
if(!$eventresults){
    echo $mysqli->error;
    exit();
  }
}
$mysqli->close();
}
else{
	header('Location: home.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $firstname . " ". $lastname?>- UniEvents</title>
	<link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php include 'nav.php'; ?>
<div id="name">
	<h1><img src="profile_images/<?php echo $photo_path; ?>"><?php echo $firstname . " ". $lastname; ?></h1>
	<h2><?php echo $university ?></h2>
</div>

<div id="events-organized" class="container">
	<div class="row">
	<h2 class="brand-yellow">Events</h2>
</div>
<?php if (isset($_SESSION['logged_in']) && $_SESSION["logged_in"] && $id==$_SESSION["id"]): ?>
	<div class="text-center">
	 	<a href="add_event.php"><button class="btn btn-primary" id="add-event">Add Event</button></a> 
	</div>
	<?php endif;?>
</div>
	<div class="container">
<?php if($events==""): ?>
	<h3 class="text-center">No events yet!</h3>
<?php else:?>
<?php while($row=$eventresults->fetch_assoc()): ?>
	<div class="row event-row">
		
	<img src="event_images/<?php echo $row['photo_path'];?>" class="col-xl-5 col-lg-7">

	<div class="col-xl-7 col-lg-5">
	<a href="event.php?event_id=<?php echo $row['id'];?>"><h5><?php echo $row["name"];?></h5></a>
	<p>WHERE: <?php echo $row["location"];?>
	<br>
	WHEN: <?php echo date('F j, Y',strtotime($row['date']));?>
	<br>
	WHAT: <?php echo $row["description"];?></p>
	
	</div>
</div>

<?php if (isset($_SESSION['logged_in']) && $_SESSION["logged_in"] && $id==$_SESSION["id"]): ?>
<div class="row">
	<div class="col-3 mx-auto">
		<button class="btn btn-danger" onclick="delete_event(<?php echo $row['id'];?>)">Delete Event</button></a>
	</div>
	</div>
<?php endif;?>
<hr class="my4">
<?php endwhile;?>
<?php endif;?>
</div>

<script>
	function delete_event(id){
		if(confirm("You are about to delete this event")){
			window.location.href = 'event_deletion.php?id='+id;
		}
	}
</script>
</body>
</html>