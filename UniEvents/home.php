<?php
require 'config.php';
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$sql="SELECT * FROM universities";
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
	<title>Home - UniEvents</title>
	<link href="https://fonts.googleapis.com/css?family=Fugaz+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="style.css" rel="stylesheet">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
	<?php include 'nav.php'; ?>
<div id="header">
	<div class="jumbotron" id="home-jumbo">
		<div id="search-area">
			<h1>UniEvents</h1>
			<div id="searchbox">
			<form class="form-inline mr-auto" action="search_results.php" method="GET">
  				<input class="form-control mr-sm-2" type="text" placeholder="Find an event..." aria-label="Search" name="search_query">
  				<select class="form-control" id="university-id" name="university">
    				<option selected value="">All Schools</option>
    				<?php while($row=$results->fetch_assoc()):?>
    				<option value=<?php echo $row['id'];?>><?php echo $row['name']; ?></option>
    			<?php endwhile; ?>
  				</select>

  				<button class="btn btn-primary" type="submit">Search</button>
 			</form>
		</div>
		</div>
	</div>
</div>

</body>
</html>