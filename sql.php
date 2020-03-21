<?php

include 'includes/dbh.inc.php';
$pass = "stan";
$hash = password_hash($pass, PASSWORD_DEFAULT);
$sql = "UPDATE users SET password = '$hash' WHERE id = 1";
$res = mysqli_query($conn, $sql);

if(mysqli_affected_rows($conn) > 0){
  echo '<script>alert("Updated");window.location.href="login.php";</script>';
} else {
echo '<script>alert("Not Updated");window.location.href="login.php";</script>';
exit();
}