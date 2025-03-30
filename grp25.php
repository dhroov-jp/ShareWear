<?php
session_start(); // Always start session at the top of the page

// Check if the user is logged in
$loggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShareWear</title>
    <!-- Preloading Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Domine:wght@400;700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Linking external stylesheet -->
    <link rel="stylesheet" href="styleshome.css">
</head>
<body>
    <header>
        <nav>
            <div class="container">
                <a href="grp25.php"> 
                    <img src="logo.jpeg" alt="ShareWear Logo" class="logo">
                </a>
                <div class="menu-toggle" id="menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <ul class="nav-li">
                    <li><a href="ngo.html">Partner NGO</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact" id="contact-us-btn">Contact Us</a></li>
                    <li class="profile-container">
                        <div class="vertical-line"></div>
                        <span id="profile-pic-btn">
                            <img src="profile.jpeg" alt="Profile" class="profile-pic">
                        </span>
                        <!-- Profile Dropdown Menu -->
                        <div id="profile-dropdown-menu">
                            <a href="login.php">Login/Signup</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container hero-content">
                <div class="hero-text">
                    <h1>JOIN OUR CAUSE</h1>
                    <p>Support our mission by donating gently used clothes to those in need.</p>
                    <div class="buttons">
                        <a href="#" id="get-started-btn">Get started with us!</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- How We Work Section -->
        <section id="how-we-work" class="how-we-work-section">
            <div class="container">
                <h2>How We Work</h2>
                <div class="work-steps">
                    <div class="step">
                        <img src="pic2.jpeg" alt="Schedule a dropoff">
                        <h3>Donation Process</h3>
                        <p>Users can browse the website and select the option to donate clothes. They are guided through providing details such as the type, condition, and quantity of items they wish to donate.</p>
                    </div>
                    <div class="step">
                        <img src="pic1.jpeg" alt="Donate at your Doorstep">
                        <h3>Donate at your Doorstep</h3>
                        <p>We will come to your doorstep to pick up the donations for larger quantity (4-5 bag full of clothes) and deliver them to the Orphanage where they can be given a new life.</p>
                    </div>
                    <div class="step">
                        <img src="pic3.jpeg" alt="Get Rewards">
                        <h3>Distribution</h3>
                        <p>Once collected, the donated clothes are sorted and distributed to those in need, often through partner organizations, charities, or shelters.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dropdown Menu -->
        <div id="dropdown-menu">
            <div class="dropdown-content">
                <h2>Contact Us</h2>
                <a href="tel:+123456789">Call Us: +123 456 789</a>
                <a href="mailto:info@sharewear.com">Email: info@sharewear.com</a>
            </div>
        </div>

        <!-- About Us Section -->
        <section id="about" class="about-section">
            <div class="container">
                <h2>About Us</h2>
                <p>ShareWear is a compassionate Donations Center committed to collecting donations through its website. Our mission is to provide support to those in need by gathering essential items and distributing them to communities facing challenges. Through our online platform, we aim to create a positive impact and promote a culture of giving back.</p>
                <p>At ShareWear, we believe in the power of collective generosity. By facilitating the donation process online, we make it convenient for individuals to contribute to those less fortunate. Join us in our commitment to making a difference in the lives of others.</p>
            </div>
        </section>
    </main>

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

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        document.addEventListener('click', function (event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const contactBtn = document.getElementById('contact-us-btn');
            const profileDropdown = document.getElementById('profile-dropdown-menu');
            const profilePicBtn = document.getElementById('profile-pic-btn');

            // Check if the click happened outside the dropdown and the buttons
            if (!dropdownMenu.contains(event.target) && !contactBtn.contains(event.target)) {
                dropdownMenu.classList.remove('show'); // Hide the dropdown if clicked outside
            }

            if (!profileDropdown.contains(event.target) && !profilePicBtn.contains(event.target)) {
                profileDropdown.classList.remove('show'); // Hide the profile dropdown if clicked outside
            }
        });

        // Contact Us Dropdown
        document.getElementById('contact-us-btn').addEventListener('click', function (e) {
            e.preventDefault();
            const contactBtn = document.getElementById('contact-us-btn');
            const dropdownMenu = document.getElementById('dropdown-menu');

            // Positioning of the dropdown based on the button's coordinates
            const rect = contactBtn.getBoundingClientRect();
            dropdownMenu.style.top = (rect.bottom + 20) + 'px';
            dropdownMenu.style.left = (rect.left - 120) + 'px'; // Adjust as needed

            dropdownMenu.classList.toggle('show'); // Toggle visibility
        });

        // Profile Dropdown
        document.getElementById('profile-pic-btn').addEventListener('click', function (e) {
            e.preventDefault();
            const profileDropdown = document.getElementById('profile-dropdown-menu');

            // Positioning of the profile dropdown based on the button's coordinates
            const rect = this.getBoundingClientRect();
            profileDropdown.style.top = (rect.bottom + 80) + 'px';
            profileDropdown.style.left = (rect.left - 150) + 'px'; // Adjust as needed

            profileDropdown.classList.toggle('show'); // Toggle visibility
        });

        // Check login status using PHP session
        function checkLogin() {
            const loggedIn = <?php echo json_encode($loggedIn); ?>; // Get session status from PHP

            if (loggedIn) {
                // If user is logged in, redirect to the donate page
                window.location.href = 'donate.html';
            } else {
                // If user is not logged in, show an alert
                alert('You must be logged in to proceed.');
            }
        }

        document.getElementById('get-started-btn').addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default anchor behavior

            // Call the function to check login
            checkLogin();
        });
    </script>
</body>
</html>
