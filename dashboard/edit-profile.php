<?php
session_start();
if (isset($_SESSION['id'])) {
    include '../includes/dbh.inc.php';
    $name = strstr($_SESSION['name'], " ", true);
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo '<div class="alert alert-danger fade center">
                              <p class="alert-heading h4">An error occured.!</p>
                          </div>';
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
      
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $image = $row['image'];
        }
    }
    
    if (isset($_POST['submit-action-update'])) {
        $file = $_FILES['image'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];
        $fileTmPName = $file['tmp_name'];
        $fileError = $file['error'];

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = array("image/jpg", "image/png", "image/jpeg", "image/pjpeg");

        if (!in_array($fileType, $allowed)) {
            echo '<script>alert("Image type not allowed. Try using images with .jpg, .png etc")</script>';
        } elseif ($fileSize <= 0 || $fileSize > 10720000) {
            echo '<script>alert("Image size exceeds 10MB");</script>';
        } elseif ($fileError !== UPLOAD_ERR_OK) {
            echo '<script>alert("There was an error while uploading your profile photo.")</script>';
        } else {
            $picture = rand(1000, 1000000).".".$fileExt;
            $folder = "profile-pics/".$picture;

            if (move_uploaded_file($fileTmPName, $folder)) {
                $sql = "UPDATE users SET image = ? WHERE id = ?";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo '<div class="alert alert-danger fade center">
                              <p class="alert-heading h4">An error occured.!</p>
                          </div>';
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ss", $picture, $_SESSION['id']);
                    mysqli_stmt_execute($stmt);

                    if (mysqli_affected_rows($conn) > 0) {
                        echo '<script>alert("PROFILE PHOTO UPDATED SUCCESSFULLY");window.location.href="edit-profile.php";</script>';
                    } else {
                        echo '<script>alert("AN ERROR OCCURED WHILE UPLOADING. PLEASE TRY AGAIN.!")</script>';
                        exit();
                    }
                }
            }
        }
    } ?>
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
  <style>
    .card-image {
      width: 250px;
      height: auto;
      margin: 0 auto;
    }
  </style>
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
        <div class="col s12 m12 hide-on-med-and-down">
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
              <form action="" method="post" enctype="multipart/form-data">
                <div class="card-image">
                  <img src="profile-pics/<?php echo $image; ?>" alt="">
                </div>
               <div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="file" name="image">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                  </div>
                </div>
               
  <button class="btn waves-effect waves-light" type="submit" name="submit-action-update">Update Profile Photo
  </button>
            </form>
            <br>
            <form action="../includes/update-info.php?id=<?php echo $_SESSION['id']; ?>" method="post">
              <div class="input-field">
                <input type="text" name="username" value="<?php echo $row['username'] ?>" id="username">
                <label for="username">Username</label>
              </div>
               <div class="input-field">
                <input type="text" name="name"  value="<?php echo $row['name'] ?>" id="name">
                <label for="name">Name</label>
              </div>
               <div class="input-field">
                <input type="email" name="email" id="email"  value="<?php echo $row['email'] ?>" class="validate">
                <label for="email">Email</label>
              </div>
               <div class="input-field">
                <textarea name="bio" id="bio" cols="30" rows="10" class="materialize-textarea"><?php echo $row['about'] ?></textarea>
                <label for="bio">Bio</label>
              </div>
              <button type="submit" name="submib-action-update-user-info" class="btn waves-effect waves-light">Update Info</button>
            </form>
            <br>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div class="input-field">
                <h1>Change Password</h1>
              </div>
              <div class="input-field">
                <input type="password" name="password" id="currentPass">
                <label for="currentPass">Current Password</label>
              </div>
              <div class="input-field">
                <input type="password" name="newPassword" id="newPass">
                <label for="newPass">New Password</label>
              </div>
              <div class="input-field">
                <input type="password" name="confirmNewPassword" id="confirmNewPass">
                <label for="confirmNewPass">Confirm New Password</label>
              </div>
              <button type="submit" name="submit-action-change-password" class="btn waves-effect waves-light">Change Password</button>
            </form>
            </div>
          </div>
      </div>
    </div>
  </section>

  <?php
  if (isset($_POST['submit-action-change-password'])) {
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      if (empty($password)) {
          echo '<script>alert("Current password field should not be left empty");</script>';
      } else {
          $sql = "SELECT * FROM users WHERE id = ?";
          $stmt = mysqli_stmt_init($conn);
          if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo '<div class="alert alert-danger fade center">
                              <p class="alert-heading h4">An error occured.!</p>
                          </div>';
              exit();
          } else {
              mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
              mysqli_stmt_execute($stmt);
              $res = mysqli_stmt_get_result($stmt);
              if (mysqli_num_rows($res) > 0) {
                  $data = mysqli_fetch_array($res);
                  $passwordCheck = password_verify($password, $data['password']);

                  if ($passwordCheck === false) {
                      header("Location: edit-profile.php?error=wrongpwd");
                      exit();
                  } elseif ($passwordCheck === true) {
                      $newPass = mysqli_real_escape_string($conn, $_POST['newPassword']);
                      $confirmNewPass = mysqli_real_escape_string($conn, $_POST['confirmNewPassword']);

                      if (empty($newPass) ||empty($confirmNewPass)) {
                          echo '<script>alert("NEW PASSWORD AND CONFIRM PASSWORD SHOULD NOT BE EMPTY");window.location.href="edit-profile.php";</script>';
                          exit();
                      } elseif ($newPass !== $confirmNewPass) {
                          echo '<script>alert("NEW PASSWORD AND CONFIRM PASSWORD SHOULD BE A POSSIBLE MATCH");window.location.href="edit-profile.php";</script>';
                          exit();
                      } else {
                          $sql = "UPDATE users SET password = ? WHERE id = ?";
                          $stmt = mysqli_stmt_init($conn);
                          if (!mysqli_stmt_prepare($stmt, $sql)) {
                              echo '<div class="alert alert-danger fade center">
                              <p class="alert-heading h4">An error occured.!</p>
                          </div>';
                              exit();
                          } else {
                              $hashedPass = password_hash($newPass, PASSWORD_DEFAULT);
                              mysqli_stmt_bind_param($stmt, "ss", $hashedPass, $_SESSION['id']);
                              mysqli_stmt_execute($stmt);

                              if (mysqli_affected_rows($conn) > 0) {
                                  echo '<script>alert("PASSWORD UPDATE SUCCESSFULLY");window.location.href="edit-profile.php";</script>';
                              } else {
                                  echo '<script>alert("AN ERROR OCCURED. PLEASE TRY AGAIN");window.location.href="edit-profile.php";</script>';
                                  exit();
                              }
                          }
                      }
                  }
              }
          }
      }
  } ?>

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