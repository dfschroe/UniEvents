<?php

require 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql="SELECT * FROM events";
if(!empty($_GET['search_query'])){
	$sql = $sql . " WHERE name LIKE '%". $_GET['search_query']. "%'";
	if(isset($_GET["university"]) && !empty($_GET['university'])){
		$sql = $sql . " AND university_id=". $_GET['university'] .";";
	}

	else{
			$sql= $sql . ";";
		}
}
else if(isset($_GET['university']) && !empty($_GET['university'])){
	$sql = $sql . " WHERE university_id = ". $_GET['university'] . ";";
}
else{
	$sql = $sql . ";";
}
$results=$mysqli->query($sql);
if(!$results){
	echo $mysqli->connect_error;
    exit();
}
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Search Results - UniEvents</title>
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
			<h1 class="brand-yellow header">Results</h1>
		</div> 
	</div> 




<div class="container">
<?php if($results==""):?>
	<div class="row">
		<h3> No events found!</h3>
	</div>
<?php else:?>
<?php while($row=$results->fetch_assoc()): ?>
	<div class="row">
		
	<img src="event_images/<?php echo $row['photo_path']; ?>" class="col-xl-5 col-lg-7">

	<div class="col-xl-7 col-lg-5">
	<a href="event.php?event_id=<?php echo $row['id'];?>"><h5><?php echo $row['name']; ?></h5></a>
	<p>WHERE: <?php echo $row['location']; ?>
	<br>
	WHEN: <?php echo date('F j, Y',strtotime($row['date']));?>
	<br>
	WHAT: <?php echo $row['description']; ?></p>
	
	</div>
</div>
<hr class="my4">
<?php endwhile?>
<?php endif;?>
</div>

</body>
</html>