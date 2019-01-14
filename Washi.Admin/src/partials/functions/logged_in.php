<?php
function logged_in(){ ?>
<main class="Main">
  <h3 class="Heading--admin u-marginTxlg">
    Lägg till användare
  </h3>
  <div class="user-form" method="post">
    <div class="Input-container">
      <label for="appNo"><strong>Lägenhetsnummer:</strong></label>
      <input class="Input u-marginTxsm" type="text" id="appNo" name="appNo">
    </div>
    <div class="Input-container u-marginTxsm">
      <label for="password"><strong>Lösenord:</strong></label>
      <input class="Input u-marginTxsm" type="password" id="password" name="password">
    </div>
    <button id="createUserButton" class="Button Button--add">Skapa användare</button>
  </div>
  <h3 class="Heading--admin u-marginTxlg">
    Ta bort användare
  </h3>
  <div class="Users-container" id="Users"></div>
  <h3 class="Heading--admin u-marginTxlg">
    Uppdatera / redigera regler
  </h3>
  <div class="Container">
    <div id="wysiwyg" data-height="300px" data-width="700px"></div>
    <button class="Button Button--add u-marginTxsm" id="update">Uppdatera</button>
  </div>
  <h2 class="Heading--admin u-marginTxlg">
    Ladda upp logotyp
  </h2>
  <div class="u-flex">
    <div id="imageContainer" class=" u-marginRmd"></div>
    <div>
      <p class="u-marginAz">Lägg in en URL till din logotyp och tryck "Ladda upp".</p>
      <input id="logoInput" type="text" class="Input u-marginTsm">
      <button id="uploadLogo" class="Button Button--add">Ladda upp</button>
    </div>
  </div>
</main>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="src/js/wysiwyg.js"></script>
<script src="src/js/main.js"></script>
<?php } ?>