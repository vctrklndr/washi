<?php
function display_login_form_error(){ ?>
  <main class="Main-login">
    <div class="Login-container">
      <div class="u-textCenter">
        <img
          class="Logo"
          src="Assets/Images/washi-logo.svg"
          alt="Washi logo"
        />
      </div>
      <h1 class="Heading Heading--small u-textCenter u-marginBlg">
        Administratör
      </h1>
      <form action="<?php echo $self; ?>" method='post'>
        <label for="username">Användarnamn:</label> <br />
        <input
          class="Input"
          type="text"
          name="username"
          id="username"
          placeholder="Användarnamn"
        />
        <br />
        <label for="password" class="u-marginTsm">Lösenord:</label> <br />
        <input
          class="Input"
          type="password"
          name="password"
          id="password"
          placeholder="Lösenord"
        />
        <div class="u-textCenter">
          <input class="Button Button--add" type="submit" name="submit" value="Logga in">
        </form>	
        <p class="u-textError u-textSmall u-textCenter">
          Du har skrivit fel användarnamn eller lösenord. Kontakta en
          administratör om problemet kvarstår.
        </p>
      </div>
    </div>
    <p class="u-textSmall u-textCenter">
      Vid problem eller frågor, vänligen kontakta admin. <br />ferb@admin.io
    </p>
  </main>
  <?php } ?>