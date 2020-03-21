<?php

include 'dbh.inc.php';

if(isset($_POST['action'])){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if(empty($email) || empty($password)){
    header("Location: ../login.php?error=empty");
    exit();
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../login.php?error=invalidmail");
    exit();
  } else {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      echo 'An error occured';
      exit();
    } else {
      mysqli_stmt_bind_param($stmt, "s", $email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $passwordCheck = password_verify($password, $row['password']);

        if($passwordCheck === false){
          header("Location: ../login.php?error=wrongpwd");
          exit();
        } else if($passwordCheck === true){
          session_start();

          $_SESSION['id'] =  $row['id'];
          $_SESSION['name'] = $row['name'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['about'] = $row['about'];
          $_SESSION['role'] = $row['role'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['course'] = $row['course'];

          header("Location: ../dashboard/index.php?success=login&section=".$_SESSION['name']);
        }
      } else {
        echo '<script>alert("User does not exist...!you can try registering and then be able to login.!");window.location.href="../signup.php";</script>';
        exit();
      }
    }
  }
} else {
  header("Location: ../login.php");
}