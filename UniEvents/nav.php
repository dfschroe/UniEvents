<nav class="navbar navbar-custom">
  <a class="navbar-brand" href="home.php">UniEvents</a>
  <?php if ( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in'] ) : ?>
    <ul class="navbar-nav ml-auto">
       <li class="nav-item">
        <a class="nav-link" href="login.php">Log In</a>
      </li>
      </ul>
    <?php else : ?>
      <a href="add_event.php" class="p-2">Add Event</a>
    	<div class="p-2 ml-auto"><a href="profile.php?name=<?php echo $_SESSION['firstname']. '_' . $_SESSION['lastname']?>" id="greeting">Hello, <?php echo $_SESSION["firstname"]?>!</a></div>

		<a class="p-2" href="logout.php">Logout</a>
  <?php endif;?>

</nav>