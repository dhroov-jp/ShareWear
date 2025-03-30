<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Collect and sanitize inputs
    $name = mysqli_real_escape_string($con, $_POST['Name']);
    $Phoneno = mysqli_real_escape_string($con, $_POST['Phone_no']);
    $Email = mysqli_real_escape_string($con, $_POST['Email']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpass']);

    // Validate email format
    if (!empty($Email) && !empty($password) && !empty($Phoneno) && filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        
        // Check if phone number is exactly 10 digits long
        if (strlen($Phoneno) != 10 || !is_numeric($Phoneno)) {
            echo "<script type='text/javascript'> alert('Phone number must be exactly 10 digits.');</script>";
        } else {
            // Check if email already exists
            $check_email_query = "SELECT * FROM form WHERE Email = '$Email' LIMIT 1";
            $email_result = mysqli_query($con, $check_email_query);

            // Check if phone number already exists
            $check_phone_query = "SELECT * FROM form WHERE Phone_no = '$Phoneno' LIMIT 1";
            $phone_result = mysqli_query($con, $check_phone_query);

            // Check if email is in use
            if (mysqli_num_rows($email_result) > 0) {
                echo "<script type='text/javascript'> alert('Email ID already in use');</script>";
            }
            // Check if phone number is in use
            elseif (mysqli_num_rows($phone_result) > 0) {
                echo "<script type='text/javascript'> alert('Phone number already in use');</script>";
            }
            else {
                // Check if passwords match
                if ($password === $cpassword) {
                    // Hash the password before saving it to the database
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert the data into the database
                    $query = "INSERT INTO form (Name, Phone_no, Email, pass) VALUES ('$name', '$Phoneno', '$Email', '$hashed_password')";
                    
                    if (mysqli_query($con, $query)) {
                        echo "<script type='text/javascript'> alert('Successfully Registered'); window.location.href = 'grp26.html'</script>";
                    } else {
                        echo "<script type='text/javascript'> alert('Error: Could not register');</script>";
                    }
                } else {
                    echo "<script type='text/javascript'> alert('Passwords do not match');</script>";
                }
            }
        }
    } else {
        echo "<script type='text/javascript'> alert('Please enter valid information');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ShareWear</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesreg.css">
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
    <div class="container">
        <div class="form-container">
            <h1>Create an Account</h1>
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="Name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                  <label for="phone.no">Phone Number</label>
                  <input type="text" name="Phone_no" placeholder="Enter your Phone number" required>
              </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="Email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="pass" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" name="cpass" placeholder="Confirm your password" required>
                </div>
                <button type="submit">Register</button>
            <div class="link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
          </form>
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
