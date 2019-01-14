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
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="src/wysiwyg.js"></script>
  <script src="src/get.js"></script>
</body>
</html>
