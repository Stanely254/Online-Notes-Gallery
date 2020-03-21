<?php
include 'dbh.inc.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

if (isset($_POST['submib-action-update-user-info'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $bio = mysqli_real_escape_string($conn, $_POST['bio']);

    if (empty($username) || empty($name) || empty($email) || empty($bio)) {
        header("Location: ../dashboard/edit-profile.php");
        exit();
    } else {
        $sql = "UPDATE users SET username = ?, name = ?, email = ?, about = ? WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "An error occured";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $username, $name, $email, $bio, $id);
            mysqli_stmt_execute($stmt);

            if (mysqli_affected_rows($conn) > 0) {
                header("Location: ../dashboard/edit-profile.php?success=info-updated");
            } else {
                echo '<script>alert("AN ERROR OCCURED. PLEASE TRY AGAIN....!");window.location.href="../dashboard/edit-profile.php";</script>';
                exit();
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../dashboard/edit-profile.php");
}
