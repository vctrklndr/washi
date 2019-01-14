<?php
session_start();
require 'src/partials/variables.php';
require 'src/partials/functions/display_login_form.php';
require 'src/partials/functions/session_logged_in.php';
require 'src/partials/functions/session_header.php';
require 'src/partials/functions/load_javascript.php';
require 'src/partials/head.php';
  // Logout
  if(isset($_GET['logout']))
  {
    unset($_SESSION['login']);
  }
  // Logged in
  if (isset($_SESSION['login']) && $_SESSION['login'] == $hash) {
    session_header();
    session_logged_in();
    load_javascript();
  }
  // Form has been submitted
  else if (isset($_POST['submit'])) {
    if ($_POST['username'] === $username && $_POST['password'] === $password){
      //If username and password are correct set the login session
      $_SESSION["login"] = $hash;
		  header("Location: $_SERVER[PHP_SELF]");
      session_header();
      session_logged_in();
      load_javascript();
    } 
    else {
      // Show login form
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
