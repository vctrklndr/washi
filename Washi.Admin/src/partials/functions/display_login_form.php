<?php
function display_login_form(){ ?>
  <main class="Main-login">
    <div class="Login-container">
      <div class="u-textCenter">
        <img
          class="Logo"
          src="src/Assets/Images/washi-logo.svg"
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
        <label for="password" class="u-marginTsm">Lösenord:</label>
        <br />
        <input
          class="Input u-marginBz"
          type="password"
          name="password"
          id="password"
          placeholder="Lösenord"
        />
        <?php
        if (isset($_POST['submit'])) {
          // Display error message
          ?>
          <p class="u-textError u-textSmall u-textCenter u-marginTsm u-marginBz">
            Du har skrivit fel användarnamn eller lösenord. Kontakta en
            administratör om problemet kvarstår.
          </p>
          <?php
        }	 
        else { 
          ?>
          <span></span>
          <?php
        } ?>
        <div class="u-textCenter u-marginTsm">
          <input class="Button Button--add" type="submit" name="submit" value="Logga in">
        </form>
      </div>
    </div>
    <p class="u-textSmall u-textCenter">
      Vid problem eller frågor, vänligen kontakta admin.
      <br />ferb@admin.io
    </p>
  </main>
<?php } ?>
