<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection
    $servername = "127.0.0.1";
    $username = "root";  // Replace with your database username
    $password = "";  // Replace with your database password
    $dbname = "donation";  // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize last_insert_id variable
    $last_insert_id = null;

    // Check if the form is for location submission
    if (isset($_POST['location-submit'])) {
        // Get location data
        $address_line_1 = $_POST['address_line_1'];
        $address_line_2 = $_POST['address_line_2'];
        $landmark = $_POST['landmark'];
        $pincode = $_POST['pincode'];
        $city = $_POST['city'];
        $state = $_POST['state'];

        // Use prepared statements for location submission
        $stmt = $conn->prepare("INSERT INTO donations (address_line_1, address_line_2, landmark, pincode, city, state) 
                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $address_line_1, $address_line_2, $landmark, $pincode, $city, $state);

        if ($stmt->execute()) {
            $last_insert_id = $stmt->insert_id; // Store the last inserted ID
            echo "Location submitted successfully. Last inserted ID: $last_insert_id";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Check if the form is for quantity submission
    if (isset($_POST['quantity-submit'])) {
        $quantity = $_POST['quantity'];
        $cloth_type = $_POST['cloth_type'];
        $age_group = $_POST['age_group'];
        $size = $_POST['size'];
        $quality = $_POST['quality'];

        // Use prepared statements for quantity submission
        $stmt = $conn->prepare("UPDATE donations SET quantity=?, cloth_type=?, age_group=?, size=?, quality=? WHERE id = ?");
        $stmt->bind_param("issssi", $quantity, $cloth_type, $age_group, $size, $quality, $last_insert_id);

        if ($stmt->execute()) {
            echo "Quantity information submitted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Check if the form is for dropoff submission
    if (isset($_POST['dropoff-submit'])) {
        $Dropoff_date = $_POST['Dropoff_date'];
        $Dropoff_time_slot = $_POST['Dropoff_time_slot'];

 
        // Use prepared statements for updating
        $stmt = $conn->prepare("UPDATE donations SET Dropoff_date=?, Dropoff_time_slot=? WHERE id = ?");
        $stmt->bind_param("ssi", $Dropoff_date, $Dropoff_time_slot, $last_insert_id);

        if ($stmt->execute()) {
            // Display the Thank You section using HTML
            echo '
 <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Thank You!</title>
                <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="stylesdon.css">
            </head>

            <body>
                <header>
                    <div class="logo-container">
                        <a href="grp26.html">
                            <img src="logo.jpeg" alt="ShareWear Logo" class="logo">
                        </a>
                    </div>
                </header>

                <main class="container">
                    <section id="thankyou-section">
                        <h1>Thank You for Your Donation!</h1>
                        <p>We appreciate your generosity. You will receive a confirmation email shortly with all the details of your donation.</p>
                        <button id="return-home-button" onclick="window.location.href=\'grp26.html\'">Return to Home Page</button>
                    </section>
                </main>

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
            </html>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    // Close the connection
    $conn->close();
}
?>
