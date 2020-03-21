<?php

include 'dbh.inc.php';
date_default_timezone_set("Africa/Nairobi");

if (isset($_POST['action'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $gender = mysqli_real_escape_string($conn, $_POST['group1']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $passwordConfirm = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    if (empty($name) || empty($username) || empty($gender) || empty($email) || empty($role) || empty($password)) {
        header("Location: ../signup.php?error=empty");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail");
        exit();
    } elseif ($password !== $passwordConfirm) {
        header("Location: ../signup.php?error=pwdmatch");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'An error occured';
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                header("Location: ../signup.php?error=uname_exists&uname=".$username);
                exit();
            } else {
                $sql = "INSERT INTO users(username, name, role, email, gender, password, course, joindate) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo 'An error occured';
                    exit();
                } else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    $time = date("Y-m-d H:i:s");
                    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $name, $role, $email, $gender, $hashedPwd, $course, $time);
                    mysqli_stmt_execute($stmt);

                    if (mysqli_affected_rows($conn) > 0) {
                        echo '<script>alert("YOU HAVE SUCCESSFULLY REGISTERED");window.location.href="../login.php";</script>';
                    } else {
                        echo '<script>alert("An error occured..!You were not registered, Please try again...!");window.location.href="../index.php";</script>';
                        exit();
                    }
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../signup.php");
}
