<?php
session_start();
if (isset($_SESSION['id'])) {
    include '../includes/dbh.inc.php';
    $name = strstr($_SESSION['name'], " ", true);
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>NotesGallery - <?php echo $_SESSION['name'] ?></title>
  <link rel="stylesheet" href="../css/materialize.min.css">
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="../css/fontawesome/css/all.css">
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
                            <li><a href="upload-notes.php" class="btn">Upload Notes</a></li>
                            <li><a class='dropdown-trigger btn btn-large' href='#' data-target='dropdown1'><?php echo $_SESSION['name'] ?> <i class="fas fa-user"></i> </a>
                                <!-- Dropdown Structure -->
                              <ul id='dropdown1' class='dropdown-content'>
                                <li><a href="check-profile.php">Account</a></li>
                                <li class="divider" tabindex="-1"></li>
                                <li><a class="waves-effect waves-light modal-trigger" href="#modal1">Logout</a></li>
                              </ul>
                            </li>
                        </ul>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <ul class="sidenav" id="mobile-nav">
        <li><a href="index.php">Dashboard</a></li>
        <li><a class='dropdown-trigger btn ' href='#' data-target='dropdown2'>My Notes <i class="fas fa-book-open"></i></a>
          <!-- Dropdown Structure -->
        <ul id='dropdown2' class='dropdown-content'>
          <li><a href="check-notes.php">View Notes</a></li>
          <li class="divider" tabindex="-1"></li>
          <li><a href="upload-notes.php">Upload Notes</a></li>
        </ul>
          </li>
          <li><a class='dropdown-trigger btn' href='#' data-target='dropdown3'>My Profile</a>
          <!-- Dropdown Structure -->
        <ul id='dropdown3' class='dropdown-content'>
          <li><a href="check-profile.php">View Profile</a></li>
          <li class="divider" tabindex="-1"></li>
          <li><a href="edit-profile.php">Edit Profile</a></li>
        </ul>
          </li>
        <li><a class="waves-effect waves-light modal-trigger btn" href="#modal1">Logout <i class="fas fa-sign-out-alt"></i></a></li>
    </ul>

    
  <section class="section">
    <div class="container-fluid">
      <div class="row">
        <div class="col s12 m12">
           <ul class="collapsible">
    <li>
      <div class="collapsible-header"><a href="index.php">Dashboard</a></div>
    </li>
    <li>
      <div class="collapsible-header">My Notes</div>
      <div class="collapsible-body"><span>
        <ul>
          <li><a href="check-notes.php">View Notes</a></li>
          <li class="divider"></li>
          <li><a href="upload-notes.php">Upload Notes</a></li>
        </ul>
      </span></div>
    </li>
    <li>
      <div class="collapsible-header">My Profile</div>
      <div class="collapsible-body"><span>
        <ul>
          <li><a href="check-profile.php">View Profile</a></li>
          <li class="divider"></li>
          <li><a href="edit-profile.php">Edit Profile</a></li>
        </ul>
      </span></div>
    </li>
  </ul>
        </div>
        <div class="col s12 m12 center-on-small-only">
          <div class="card">
            <div class="card-content">
              <form action="../includes/upload-notes.inc.php?uploader=<?php echo $_SESSION['name'] ?>&course=<?php echo $_SESSION['course'] ?>" method="post" enctype="multipart/form-data">
                <div class="input-field">
                  <h1>Upload Note</h1>
                </div>
                <div class="input-field">
                  <input id="note" type="text" name="note-title" required>
                  <label for="note">Create Note Title</label>
                </div>
                <div class="input-field">
                  <input type="text" name="short-note-desc" required id="shortnote">
                  <label for="short-note-desc">Create Short Note Description</label>
                </div>
                <div class="input-field">
                  <p><b>Select</b> <span class="red-text">(Allowed file type: 'pdf', 'doc', 'ppt', 'zip' | Allowed Maximum size is: <b>30MB</b>)</span></p>
                </div>
                  <div class="input-field">
                  <input type="file" name="document">
                </div>
                <button type="submit" name="submit-action-upload" class="waves-effect waves-light btn">Upload</button>
              </form>              
            </div>
          </div>
      </div>
    </div>
</section>

  <footer class="note-footer center">
    <div class="container">
      <p class="flow-text">NotesGallery &COPY; <script>document.write(new Date().getFullYear());</script></p>
    </div>
  </footer>


    <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4 class="center">Leaving so soon</h4>
      <div class="input-field center">
        <a class="waves-effect waves-light btn" href="../includes/signout.inc.php">Yes</a>
        <a class="waves-effect waves-light btn modal-close">Cancel</a>
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>

  <script src="../js/materialize.min.js"></script>
  <script>
    M.AutoInit();
  </script>
</body>
</html>
<?php
} else {
        echo '<script>alert("You need to login to view this page.!");window.location.href="../login.php";</script>';
        exit();
    }?>