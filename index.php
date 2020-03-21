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

     <section class="slider">
    <ul class="slides">
      <li>
        <img src="images/slider/slide1.jpg" alt="">
        <div class="caption center-align">
          <h4 class="white-text">Easy Notes Management</h4>
          <p class="light white-text hide-on-small-only">Now easily manage all kind of notes by upload them here.</p>
        </div>
      </li>
      <li>
        <img src="images/slider/slide2.jpg" alt="">
        <div class="caption left-align">
          <h4>Upload Various Files.</h4>
          <p class="light white-text hide-on-small-only">User can upload various types of files including PDFs, DOCX, etc</p>
        </div>
      </li>
      <li>
        <img src="images/slider/slide3.jpg" alt="">
        <div class="caption right-align">
          <h4 class="white-text">Controlled By Admin</h4>
          <p class="light white-text hide-on-small-only">Everything is managed and controlled by administrator</p>
        </div>
      </li>
      <li>
        <img src="images/slider/slide3.jpg" alt="">
        <div class="caption right-align">
          <h4 class="white-text">Login For Both Teacher And Student</h4>
          <p class="light white-text hide-on-small-only">Both teacher and student can login and upload notes</p>
        </div>
      </li>
    </ul>
  </section>

   <footer class="section center">
    <p class="flow-text">NotesGallery &COPY; <script>document.write(new Date().getFullYear());</script></p>
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

  <script src="js/materialize.min.js"></script>
  <script>
     //Sidenav 
    const sideNav = document.querySelector('.sidenav');
    M.Sidenav.init(sideNav, {});

    //slides 
    const slider = document.querySelector('.slider');
    M.Slider.init(slider, {
      indicators: false,
      height: 600,
      transition: 300,
      interval: 6000
    });

    //Modals
    const modal = document.querySelector('.modal');
    M.Modal.init(modal, {});
  </script>
</body>

</html>