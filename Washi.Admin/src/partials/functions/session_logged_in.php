<?php function session_logged_in(){ ?>
<main class="Main">
  <?php
    require 'src/partials/add_user.php';
    require 'src/partials/remove_user.php';
    require 'src/partials/edit_rules.php';
    require 'src/partials/update_logo.php';
  ?>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="src/js/wysiwyg.js"></script>
  <script src="src/js/main.js"></script>
</main>
<?php } ?>