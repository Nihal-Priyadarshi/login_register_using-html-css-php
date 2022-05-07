<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
  header("location: login.php");
}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Welcome to Admin Home</title>
  <link rel="stylesheet" href="./css/welcome.css">
</head>

<body>
  <header class="flexbox">
    <nav class="flexbox">
      <h1>Auditorium Booking System</h1>
      <a class="home" target="_blank" href="./register.php">Add Admin</a>
      <a class="logout" href="./logout.php">Logout</a>
      <h3><?php echo "Welcome " . $_SESSION['username']?></h3>
    </nav>
  </header>
  
  <main class="flexbox"></main>
</body>

</html>