<?php

session_start();

include 'dbh.inc.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if (isset($_SESSIO['id'])) {
    if (isset($_POST['submit-action-change-password'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if (empty($password)) {
            header("Location: ../dashboard/edit-profile.php");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "An error occured";
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "s", $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $passwordCheck = password_verify($password, $row['password']);

                    if ($passwordCheck === false) {
                        header("Location: ../dashboard/edit-user.php?error=wrongpwd");
                        exit();
                    } elseif ($passwordCheck === true) {
                        $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
                        $confirmNewPassword = mysqli_real_escape_string($conn, $_POST['confirmNewPassword']);

                        if (empty($newPassword) || empty($confirmNewPassword)) {
                            header("Location: ../dashboard/edit-user.php?error=emptyPass");
                            exit();
                        } elseif ($newPassword !== $confirmNewPassword) {
                            header("Location: ../dashboard/edit-user.php?error=pwdmatch");
                            exit();
                        } else {
                            $sql = "UPDATE users SET password = ? WHERE id = ?";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "An error occured";
                                exit();
                            } else {
                                $hashedPwd = password_hash($newPassword, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $id);
                                mysqli_stmt_execute($stmt);

                                if (mysqli_affected_rows($conn) > 0) {
                                    header("Location: ../dashboard/edit-profile.php?success=pwd_updated");
                                } else {
                                    echo '<script>alert("AN ERROR OCCURED. PLEASE TRY AGAIN");window.location.href="../dashboard/edit-profile.php";</script>';
                                    exit();
                                }
                            }
                        }
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        header("Location: ../dashboard/edit-profile.php");
    }
} else {
    echo '<script>alert("ONLY THE USER CAN UPDATE THEIR PASSWORD");
  window.location.href="../login.php";</script>';
}
