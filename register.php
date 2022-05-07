<?php
require_once "config.php";

$add_new_username = $add_new_password = $add_new_confirm_password = "";
$add_new_username_err = $add_new_password_err = $add_new_confirm_password_err = "";

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
  header("location: login.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
  {
    header("location: login.php");
  }
  else{
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
      $add_new_username_err = "Username cannot be blank";
      echo '<script>alert("Username cannot be blank"); location.href = "./register.php";</script>';
    }
    else{
      $sql = "SELECT id FROM Admin WHERE username = ?";
      $stmt = mysqli_prepare($con, $sql);
      if($stmt)
      {
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        // Set the value of param username
        $param_username = trim($_POST['username']);

        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)){
          mysqli_stmt_store_result($stmt);
          if(mysqli_stmt_num_rows($stmt) == 1)
          {
            $add_new_username_err = "This username is already taken";
            echo '<script>alert("This username is already taken"); location.href = "./register.php";</script>';
          }
          else{
            $add_new_username = trim($_POST['username']);
          }
        }
        else{
          echo "Something went wrong";
        }
      }
    }

    mysqli_stmt_close($stmt);

    // Check for password
    if(empty(trim($_POST['password']))){
      $add_new_password_err = "Password cannot be blank";
      echo '<script>alert("Password cannot be blank");</script>';
    }
    elseif(strlen(trim($_POST['password'])) < 5){
      $add_new_password_err = "Password cannot be less than 5 characters";
      echo '<script>alert("Password cannot be less than 5 characters");</script>';
    }
    else{
      $add_new_password = trim($_POST['password']);
    }

    // Check for confirm password field
    if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
      $add_new_password_err = "Passwords should match";
      echo '<script>alert("Password should match");</script>';
    }

    // If there were no errors, insert data into the database
    if(empty($add_new_username_err) && empty($add_new_password_err) && empty($add_new_confirm_password_err))
    {
      $sql = "INSERT INTO Admin (username, password) VALUES (?, ?)";
      $stmt = mysqli_prepare($con, $sql);
      if ($stmt)
      {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $add_new_username;
        $param_password = password_hash($add_new_password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {

        ?>
        <script>
          var add_new_username = <?php echo json_encode($add_new_username); ?>;
          var add_new_password = <?php echo json_encode($add_new_password); ?>;
        </script>
        <?php
          echo '<script>alert("Note down these results to Login by different ID.\nUsername: " + add_new_username + "\nPassword: " + add_new_password); window.close();</script>';
        }
        else{
          echo '<script>alert("Something went wrong... cannot redirect!"); location.href = "./register.php";</script>';
        }
      }
      mysqli_stmt_close($stmt);
    }
    mysqli_close($con);
  }
}

?>


<!doctype html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register New Admin</title>
  <link rel="stylesheet" href="./css/register.css">
</head>

<body class="flexbox">
  <header class="flexbox">
    <nav class="flexbox">
      <h1>Auditorium Booking System</h1>
      <a class="home" href="./welcome.php">Home</a>
      <a class="logout" href="./logout.php">Logout</a>
    </nav>
  </header>
  
  <main>
    <div class="heading">
      <h2>Add Admin Here:</h2>
    </div>
    <form action="" method="post">
      <input type="text" name="username" placeholder="Username">
      <div class="input">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
      </div>
      <button type="submit">Add</button>
    </form>
  </main>
</body>

</html>