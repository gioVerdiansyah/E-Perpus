<?php
session_start();
// jika user sudah login
// if (isset($_SESSION["login"])) {
//     header("Location: Home-Admin.htm");
//     exit;
// }
require "function.php";

$massage = "";

if (isset($_POST["submit"])) {
    global $massage;
    if (register($_POST) === 1) {
        // fungsi register berhasil dan ada user yang berhasil masuk 0 dari mysqli_affected_rows
        $massage = "<p style='color:green;margin:0;'>register berhasil! <a href='Login.php'>Login?</a></p>";
    } else {
        global $massage;
        $error = $_SESSION["error"];
        $massage = "<p style='color:red;margin:0;'>register gagal karena $error</p>";
    }
}
// $massage ini untuk mencetak pesan 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li> <label for="username">Username :</label><br>
            <input type="text" name="username" id="username" required>
        </li>
        <li>
            <label for="pass">Password :</label><br>
            <input type="password" name="pass" id="pass" required>
        </li>
        <li>
            <label for="confirmPass">Confirmation Password :</label><br>
            <input type="password" name="confirmPass" id="confirmPas" required>
        </li>
        <li>
            <label for="gambar">Photo Profile</label><br>
            <input type="file" name="gambar" id="gambar" required>
        </li>
        <?php echo $massage; ?>

        <li style="margin: 5px 0;">
            <button type="submit" name="submit">Sign Up</button>
            <a href="login-admin.php">Login?</a>
        </li>
    </ul>
</form>

<body>

</body>

</html>