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
                            <li><a href="dashboard/upload-notes.php" class="waves-effect waves-light btn">Upload Notes</a></li>
    </ul>

     <section class="section">
      <div class="container">
      <div class="card">
        <div class="card-content blue-text">
          <div class="card-title">
            <h5>An e-mail will be sent to you with instructions on how to reset your password.</h5>
          </div>
          <form action="">
        <div class="input-field">
          <input id="password" name="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Reset Password
  </button>
          </form>
        </div>
      </div>
      </div>
    </section>


     <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4 class="center">About Us</h4>
      <p>Online Notes Gallery is an online platform that lets teachers and students uploads, share and download various notes on different subjects/courses they are taking.</p>
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
</body>
</html>