<?php
require 'config.php';
if( !isset($_SESSION['logged_in']) && !$_SESSION['logged_in']) {

  header('Location: home.php');
}
if(!isset($_GET["id"]) || empty($_GET["id"])){
  header('Location: home.php');
}
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
  }
$sql="DELETE FROM events WHERE id=". $_GET["id"];
$results= $mysqli->query($sql);
if ( !$results ) {
    echo $mysqli->error;
    exit();
  }
$mysqli->close();

?>
<!DOCTYPE html>
<html>
<head>
	<title>Event Deletion - UniEvents</title>
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
      <h1 class="brand-yellow header">Delete Event</h1>
    </div> 
  </div> 
<p class="text-success text-center">Event Successfully Deleted</p>
<div class="text-center" >
  <a href="<?php echo $_SERVER['HTTP_REFERER']?>"><button class="btn btn-primary mx-auto" id="view-event">Back to Profile</button></a>
</div>
			


</body>
</html>