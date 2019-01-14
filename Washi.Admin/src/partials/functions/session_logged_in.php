<?php
function session_logged_in(){ ?>
<main class="Main">
  <a href="index.php?page=add_user">Lägg till användare</a>
  <a href="index.php?page=remove_user">Ta bort användare</a>
  <a href="index.php?page=edit_rules">Uppdatera regler</a>
  <a href="index.php?page=update_logo">Uppdatera logotyp</a>
  <?php
    require 'src/partials/add_user.php';
    require 'src/partials/remove_user.php';
    require 'src/partials/edit_rules.php';
    require 'src/partials/update_logo.php';

    // switch ($_GET['page'])
    // {
    //   case "add_user":
    //   include 'src/partials/add_user.php';
    //   break;
      
    //   case "remove_user":
    //   include 'src/partials/remove_user.php';
    //   break;
      
    //   case "edit_rules":
    //   include 'src/partials/edit_rules.php';
    //   break;

    //   case "update_logo":
    //   include 'src/partials/update_logo.php';
    //   break;

    //   default:
    //   require 'src/partials/add_user.php';
    //   }

    // include($_GET['page'].'.php');
  ?>
</main>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="src/js/wysiwyg.js"></script>
<script src="src/js/main.js"></script>
<?php } ?>