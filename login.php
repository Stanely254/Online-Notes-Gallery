<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Online Notes Gallery</title>
  <link rel="stylesheet" href="css/materialize.min.css">
  <link rel="stylesheet" href="css/fontawesome/css/all.css">
  <link rel="stylesheet" href="css/custom.css">
</head>

<body>

  <div class="navbar-fixed">
    <nav class="teal">
      <div class="container">
        <div class="nav-wrapper">
          <a href="index.php" class="brand-logo">NotesGallery</a>
          <a href="#" class="sidenav-trigger" data-target="mobile-nav">
            <i class="fas fa-bars"></i>
            <ul class="right hide-on-med-and-down">
              <li><a class="waves-effect waves-light btn modal-trigger" href="#modal1">About Us</a></li>
              <li><a href="login.php" class="waves-effect waves-light btn">Login</a></li>
              <li><a href="signup.php" class="waves-effect waves-light btn">Signup</a></li>
              <li><a href="dashboard/upload-notes.php" class="waves-effect waves-light btn">Upload Notes</a></li>
            </ul>
          </a>
        </div>
      </div>
    </nav>
  </div>

  <ul class="sidenav" id="mobile-nav">
    <li><a class="waves-effect waves-light btn modal-trigger" href="#modal1">About Us</a></li>
    <li><a href="login.php" class="waves-effect waves-light btn">Login</a></li>
    <li><a href="signup.php" class="waves-effect waves-light btn">Signup</a></li>
    <li><a href="" class="waves-effect waves-light btn">Upload Notes</a></li>
  </ul>

  <section class="section">
    <div class="container">
      <div class="input-field">
        <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] === "empty") {
            echo '<div class="alert alert-danger fade  center">
                              <p class="alert-heading h4">Ensure that you fill all the required fields</p>
                          </div>';
          } elseif ($_GET['error'] === "invalidmail") {
            echo '<div class="alert alert-danger fade center">
                              <p class="alert-heading h4">Use a valid email address..!</p>
                          </div>';
          } elseif ($_GET['error'] === "wrongpwd") {
            echo '<div class="alert alert-danger fade center">
                              <p class="alert-heading h4">Ensure that you use the correct password.!</p>
                          </div>';
          }
        }
        ?>
      </div>
      <div class="card">
        <div class="card-content blue-text">
          <form action="includes/signin.inc.php" method="post">
            <div class="input-field">
              <input id="last_name" name="email" type="text" class="validate">
              <label for="last_name">Username or E-mail Address</label>
            </div>
            <div class="input-field">
              <input id="password" name="password" type="password" class="validate">
              <label for="password">Password</label>
            </div>
            <button type="submit" name="action" class="btn waves-effect waves-light">Login
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Modals -->
  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4 class="center">About Us</h4>
      <p>Online Notes Gallery is an online platform that lets teachers and students uploads, share and download various
        notes on different subjects/courses they are taking.</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>

  <script src="js/jquery/jquery.min.js"></script>
  <script src="js/materialize.min.js"></script>
  <script>
  M.AutoInit();
  </script>
  <script>
  setTimeout(() => document.querySelector('.alert').remove(), 3000);
  </script>
</body>

</html>