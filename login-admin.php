<?php
session_start(); //memulai session
// cek COOKIE

$db = mysqli_connect(
    "localhost",
    "root",
    "",
    "perpus"
);

if (isset($_COOKIE["UIuDSteKukki"]) && isset($_COOKIE["UNmeKySteKukki"])) {
    // cek dulu ada atau tidak
    $id = $_COOKIE["UIuDSteKukki"];
    $key = $_COOKIE["UNmeKySteKukki"];

    // cek username berdasarkan id
    $result = mysqli_query($db, "SELECT username FROM loginadmin WHERE id='$id'");
    $row = mysqli_fetch_assoc($result); //ambil

    // cek COOKIE dan username
    if ($key === hash("sha512", $row["username"])) {
        $_SESSION["login"] = true;
    }
}
// jika SESSION["login"] nya ada maka pindah ke index
if (isset($_SESSION["login"])) {
    header("Location: Home-Admin.php");
    exit;
}

if (isset($_POST["submit"])) {
    // tampung
    $username = $_POST["username"];
    $pass = $_POST["pass"];

    $result = mysqli_query($db, "SELECT * FROM loginadmin WHERE username = '$username'");

    // cek username-nya
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($pass, $row["password"])) {

            // cek input checkbox Remember Me!
            if (isset($_POST["remember"])) {
                // buat COOKIE
                $time = time() + 60 * 60 * 24;
                setcookie("UIuDSteKukki", $row["id"], $time);
                setcookie("UNmeKySteKukki", hash("sha512", $row["username"]), $time);
            }

            // cek session
            $_SESSION["login"] = true;
            header("Location: Home-Admin.php");
            exit;
        }

    }
    $err = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label><br>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Password :</label><br>
                <input type="password" name="pass" id="password" required>
            </li>
            <li>
                <!-- COOKIE -->
                <input type="checkbox" checked name="remember" id="remember">
                <label for="remember">Remember Me!</label>
            </li>

            <!-- pesan kesalahan error -->
            <?php if (isset($err)): ?>
                <p style="color: red;margin:0;">Username atau Password salah!</p>
            <?php endif ?>

            <li style="margin: 5px 0;">
                <button type="submit" name="submit">Login!</button>
                <a href="register.php">registrasi</a>
            </li>
        </ul>
    </form>
</body>

</html>