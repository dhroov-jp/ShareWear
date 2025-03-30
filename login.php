<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // Collect and sanitize user input
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  if (!empty($username) && !empty($password)) {
    // Check if the user exists in the database using either email or phone number
    $query = "SELECT * FROM form WHERE (Email='$username' OR Phone_no='$username') AND pass='$password' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);

      $_SESSION['user_id'] = $user_data['id'];
      $_SESSION['Name'] = $user_data['Name'];

      echo "<script type='text/javascript'>
      alert('Login successful');
      window.location.href = 'grp26.html';
    </script>";

die;

      echo "<script type='text/javascript'>alert('Login successful'); window.location.href = 'grp25.html';</script>";
    } else {
      echo "<script type='text/javascript'> alert('Invalid username or password');</script>";
    }
  } else {
    echo "<script type='text/javascript'> alert('Please fill all fields');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ShareWear Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styleslogin.css"> 
</head>
<body>
  <header>
    <nav>
      <div class="container">
        <a href="grp25.php"> 
          <img src="logo.jpeg" alt="ShareWear Logo" class="logo">
        </a>
        <div class="menu-toggle">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <ul class="nav-li">
          <li class="profile-container">
            <a href="login.php">
              <img src="profile.jpeg" alt="Profile" class="profile-pic">
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Login form section -->
  <div class="container login-container">
  <h1>Login</h1>
  <form method="POST">
  <div class="form-group">
      <label for="username">Email-id/Phone Number</label>
      <input type="text" name="username" id="username" placeholder="Enter Email-id/Phone Number">
    </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Enter password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>

  <!-- Moved the links inside the login container -->
  <div class="links">
    <a href="fpass.html">Forgot Password?</a>
    <a href="register.php">Don't have an Account?</a>
  </div>
</div>

    <!-- Footer Section -->
    <footer>
      <div class="footer-container">
          <p>&copy; 2024 ShareWear. All rights reserved.</p>
          <div class="social-icons">
              <a href="#"><img src="fblogo.jpeg" alt="Facebook"></a>
              <a href="#"><img src="twitterlogo.jpeg" alt="Twitter"></a>
              <a href="#"><img src="iglogo.jpeg" alt="Instagram"></a>
          </div>
      </div>
  </footer>  

</body>
</html>
