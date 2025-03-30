<?php
// logout.php
session_start();

// Destroy all session data to log out the user
session_unset();
session_destroy();

// Send a response back to the JavaScript
echo 'logged_out';
?>
