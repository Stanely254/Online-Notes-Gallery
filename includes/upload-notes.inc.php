 <?php

include 'dbh.inc.php';
$file_uploader = isset($_GET['uploader']) ? $_GET['uploader']: "";
$file_uploaded_to = isset($_GET['course']) ? $_GET['course']: "";


if (isset($_POST['submit-action-upload'])) {
    $noteTitle = mysqli_real_escape_string($conn, $_POST['note-title']);
    $shortNoteDesc = mysqli_real_escape_string($conn, $_POST['short-note-desc']);

    $file= $_FILES['document'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileType = $file['type'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowed = array('pdf', 'docx', 'doc', 'txt', 'ppt', 'zip');
    if (empty($fileName)) {
        echo '<script>alert("ATTACH A FILE");window.location.href="../dashboard/upload-notes.php";</script>';
        exit();
    } elseif($fileSize <= 0 || $fileSize > 30720000){
        header("Location: ../dashboard/upload-notes.php?error=filesize");
        exit();
    } elseif (!in_array($ext, $allowed)) {
        header("Location: ../dashboard/upload-notes.php?error=invalidfile");
        exit();
    } else {
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $noteFile = rand(1000, 1000000).".".$fileExt;
        $folder = '../dashboard/uploads/'.$noteFile;

        if (move_uploaded_file($fileTmpName, $folder)) {
            $sql = "INSERT INTO uploads(file_name, file_description, file_type, file_uploader, file_uploaded_to, file) VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo 'An error occured';
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ssssss", $noteTitle, $shortNoteDesc, $fileExt, $file_uploader, $file_uploaded_to, $noteFile);
                mysqli_stmt_execute($stmt);

                if (mysqli_affected_rows($conn) > 0) {
                    header("Location: ../dashboard/check-notes.php?success=note-added");
                } else {
                    echo '<script>alert("AN ERROR OCCURED...!PLEASE TRY AGAIN.!");window.location.href="../dashboard/upload-notes.php";</script>';
                    exit();
                }
            }
        } else {
            echo '<script>alert("AN ERROR OCCURED WHILE UPLOADING.");window.location.href="../dashboard/upload-notes.php";</script>';
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../dashboard/upload-notes.php");
}
