<?php

include 'dbh.inc.php';

$id = isset($_GET['id']) ? $_GET['id'] : "";

$sql = "DELETE FROM uploads WHERE id = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "An error occured";
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($conn) > 0) {
        header("Location: ../dashboard/check-notes.php?success=deleted-note");
    } else {
        header("Location: ../dashboard/check-notes.php?error=deleted-note");
        exit();
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
