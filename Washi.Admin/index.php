<?php
session_start();
require 'variables.php';
require 'display_login_form.php';
require 'logged_in.php';
require 'session_header.php';
require 'header.php';
  // Logout
  if(isset($_GET['logout']))
  {
    unset($_SESSION['login']);
  }
  // Login
  if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) {
    session_header();
    logged_in();
  }
  // Form has been submitted
  else if (isset($_POST['submit'])) {
    if ($_POST['username'] === $username && $_POST['password'] === $password){
      //If username and password are correct set the login session
      $_SESSION["login"] = $hash;
		  header("Location: $_SERVER[PHP_SELF]");
      session_header();
      logged_in();
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
