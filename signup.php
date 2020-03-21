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
    <h2 class="flow-text center">Fill out this form so that we get you started.!</h2>
   <div class="card black-text">
        <div class="card-content white-text">
           <form action="includes/signup.inc.php" method="post">
           <div class="input-field">
             <?php
             if (isset($_GET['error'])) {
                 if ($_GET['error'] === "empty") {
                     echo '<div class="alert alert-danger">
                              <p class="alert-heading h4">Ensure that you fill all the required fields</p>
                          </div>';
                 } elseif ($_GET['error'] === "invalidmail") {
                     echo '<div class="alert alert-danger">
                              <p class="alert-heading h4">Use a valid email address..!</p>
                          </div>';
                 } elseif ($_GET['error'] === "pwdmatch") {
                     echo '<div class="alert alert-danger">
                              <p class="alert-heading h4">Your passwords don\'t match</p>
                          </div>';
                 } elseif ($_GET['error'] === "uname_exists") {
                     echo '<div class="alert alert-danger">
                              <p class="alert-heading h4">Username: <b>'.$_GET['uname'].'</b> already exists</p>
                          </div>';
                 }
             }
             ?>
           </div>
      <div class="input-field">
      <input id="name" type="text" name="name" class="validate" required>
      <label for="name">First & Last name</label>
    </div>
    <div class="input-field">
     <input id="uid" type="text" name="username" data-length="10" required>
            <label for="uid">Create Username</label>
    </div>
    <div class="input-field">
          <input id="email" name="email" type="email" class="validate" required>
          <label for="email">E-mail Address</label>
          <span class="helper-text" data-error="wrong" data-success="right">Use a valid email address</span>
        </div>
        <div class="input-field">
        <p>
      <label>
        <input name="group1" value="Male" type="radio"/>
        <span>Male</span>
      </label>
    </p>
    <p>
      <label>
        <input name="group1" value="female" type="radio" />
        <span>Female</span>
      </label>
    </p>
        </div>

        <div class="input-field">
     <input id="phone" type="number" name="phone" data-length="10" required>
            <label for="phone">Telephone</label>
    </div>
        <div class="input-field">
    <select multiple name="role">
      <option disabled>I am a </option>
      <option value="teacher">Teacher</option>
      <option value="student">Student</option>
    </select>
  </div>
   <div class="input-field">
    <select multiple name="course">
      <option disabled>Choose Course</option>
      <option value="Computer Science">Computer Science</option>
      <option value="Agriculture">Agriculture</option>
    </select>
  </div>
 <div class="input-field">
          <input id="password" type="password" name="password" class="validate" required>
          <label for="password">Create Password</label>
        </div>
        <div class="input-field">
          <input id="passwordConfirm" type="password" name="confirmPassword" class="validate" required>
          <label for="passwordConfirm">Confirm Password</label>
        </div>

        <button type="submit" name="action" class="btn waves-effect waves-light">Sign Up
  </button> <span class="black-text">or</span> <a class="btn waves-effect waves-light" href="login.php">Login
  </a>
    </form>
        </div>
      </div>
  </div>
</section>

   <footer class="section gray black-text center">
    <p class="flow-text">TembeaKenya &COPY; 2019</p>
  </footer>

    <!-- Modals -->
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
    $(document).ready(function(){
      $('input.input_text').characterCounter();
    });
  </script>
  <script>
    M.AutoInit();
  </script>
</body>

</html>