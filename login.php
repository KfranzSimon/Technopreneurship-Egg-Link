<?php 
session_start();
include 'php/connection.php';

  $error = '';

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['Email'];
    $password = $_POST['Pass'];

    if($email != '' && $password != ''){
      $sql = "SELECT * FROM users Where email='$email' AND password='$password'";
      $result = mysqli_query($conn, $sql);

      if(mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_assoc($result);
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['user_name'] = $row['full_name'];
      header("Location: index.php");
      exit;
      }else{
        $error = "error email or password";
      }
    }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EggLink Login</title>
<link rel="stylesheet" href="css/login.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-container">
  <div class="login-card">
    <div class="logo">
      <img src="assets/logo.png" alt="EggLink Logo">
    </div>
    <h2>Welcome to EggLink</h2>
    <p>Sign in to your account</p>
    <?php if($error){ echo "<p style ='color: red;'>$error</p>";}?>
    <form id="login-form" method ="post">
      
      <label for="email">Email</label>
      <input type="email" id="email" name="Email" placeholder="Enter your email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="Pass" placeholder="Enter your password" required>

      <div class="login-options">
        <label><input type="checkbox" id="remember"> Remember me</label>
        <a href="#">Forgot password?</a>
      </div>

      <button type="submit">Sign In</button>
    </form>
    <p class="signup-text">Don't have an account? <a href="#">Sign Up</a></p>
  </div>
</div>

</body>
</html>