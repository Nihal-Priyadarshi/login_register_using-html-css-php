<?php
require_once "config.php";

session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
  header("location: welcome.php");
  exit;
}

$username = $password = "";
$err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
  if(empty(trim($_POST['username'])) || empty(trim($_POST['password']))) 
  {
    $err = "Please enter Username or Password";
    echo '<script>alert("Please enter Username or Password")</script>';
  }
  else{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
  }

  if(empty($err))
  {
    $sql = "SELECT id, username, password FROM Admin WHERE username = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;

    // Executing this statement
    if(mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      if(mysqli_stmt_num_rows($stmt) == 1)
      {
        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
        if(mysqli_stmt_fetch($stmt))
        {
          if(password_verify($password, $hashed_password))
          {
            // Allowing user to login
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["id"] = $id;
            $_SESSION["loggedin"] = true;

            //Redirect user to welcome page
            header("location: welcome.php");
          }
          else{
            echo '<script>alert("Password is wrong")</script>';
          }
        }
      }
      else{
        echo '<script>alert("Please enter a valid Username")</script>';
      }
    }
  }
}

?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin login</title>
  <link rel="stylesheet" href="./css/login.css">
</head>

<body class="flexbox">
  <header class="flexbox">
    <nav class="flexbox">
      <h1>Auditorium Booking System</h1>
      <a href="#">Home</a>
    </nav>
  </header>
  <main class="flexbox">
    <form class="container flexbox" action="" method="post">
      <h1>welcome</h1>
      <input type="text" name="username" placeholder="Username">
      <input type="password" name="password" placeholder="Password">
      <input type="submit" name="" value="Login">
    </form>
  </main>
</body>

</html>