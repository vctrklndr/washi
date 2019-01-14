<!--
This switch case is not used, but is saved here if I figure
out how to use it with the JS.
-->
<a href="?page=add_user">Lägg till användare</a>
<a href="?page=remove_user">Ta bort användare</a>
<a href="?page=edit_rules">Uppdatera regler</a>
<a href="?page=update_logo">Uppdatera logotyp</a>

<?php
switch ($_GET['page'])
  {
    case "add_user":
    require 'src/partials/add_user.php';
    break;

    case "remove_user":
    require 'src/partials/remove_user.php';
    break;

    case "edit_rules":
    require 'src/partials/edit_rules.php';
    break;

    case "update_logo":
    require 'src/partials/update_logo.php';
    break;

    default:
    require 'src/partials/add_user.php';
  }
include($_GET['page']);