<?php
function session_header(){ ?>
<header class="Header">
  <div class="">
    <img class="Logo-header" src="Assets/Images/washi-logo.svg" alt="Washi logo" />
    <h1 class="Heading Heading--small">Administratör</h1>
  </div>
  <nav style="display: flex; align-items: center;">
    <input id="searchInput" class="Input u-marginAz u-marginRmd" placeholder="Sök..."></input>
    <ul class="PageNav">
      <li class="PageNav-link">
        <a href="?logout=true" class="Button Button--delete">Logga ut</a>
      </li>
    </ul>
  </nav>
</header>
<?php } ?>