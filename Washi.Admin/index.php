<?php
session_start();
require 'src/partials/variables.php';
require 'src/partials/functions/display_login_form.php';
require 'src/partials/functions/session_logged_in.php';
require 'src/partials/functions/session_header.php';
require 'src/partials/head.php';
  // Logout
  if(isset($_GET['logout']))
  {
    unset($_SESSION['login']);
  }
  // Login
  if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) {
    session_header();
    session_logged_in();
  }
  // Form has been submitted
  else if (isset($_POST['submit'])) {
    if ($_POST['username'] === $username && $_POST['password'] === $password){
      //If username and password are correct set the login session
      $_SESSION["login"] = $hash;
		  header("Location: $_SERVER[PHP_SELF]");
      session_header();
      session_logged_in();
    } 
    else {
      // Display login form with error (error message is set in the function)
      display_login_form();
    }
  }	 
  // Show login form
  else { 
    display_login_form();
  }
  ?>
</body>
</html>
