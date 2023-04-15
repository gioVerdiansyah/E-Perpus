<?php
session_name("SESSILGN");
require 'function.php';
session_start(); //memulai session

if (isset($_COOKIE["UUsSRlGn=thORoe"]) && isset($_COOKIE["UDsSRlGn=thORue"])) {
  // cek dulu ada atau tidak
  $id = $_COOKIE["UUsSRlGn=thORoe"];
  $key = $_COOKIE["UDsSRlGn=thORue"];

  // cek username berdasarkan id
  $result = mysqli_query($db, "SELECT username FROM loginadmin WHERE id='$id'");
  $row = mysqli_fetch_assoc($result); //ambil

  // cek COOKIE dan username
  if ($key === hash("sha512", $row["username"])) {
    $_SESSION["login-user"] = true;
  }
}
// jika SESSION["login"] nya ada maka pindah ke welcome
if (isset($_SESSION["login-user"])) {
  header("Location: welcome.php");
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
        setcookie("UUsSRlGn=thORoe", $row["id"], $time);
        setcookie("UDsSRlGn=thORue", hash("sha512", $row["username"]), $time);
      }

      // cek session
      $_SESSION["login-user"] = true;
      header("Location: welcome.php");
      exit;
    }

  }
  $err = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login dulu~</title>
    <link rel="stylesheet" href="User/CSS/index.css" />
</head>

<body>
    <div class="image">
        <!-- <img src="User/Assets/bg6-2.svg" alt="bg6-2.svg" /> -->
    </div>
    <main>
        <h1>Selamat Datang <span id="hello">&#128075</span></h1>
        <form action="" method="post">
            <ul>
                <li>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan nama" maxlength="64"
                        required />
                </li>
                <li>
                    <label for="pass">Password</label>
                    <input type="password" name="pass" id="pass" maxlength="144" required />
                </li>
                <li><input type="checkbox" name="remember" checked /> Remember Me</li>
                <li>
                    <button type="submit" name="submit">Send</button>
                </li>
            </ul>
        </form>
        <p>Belum terdaftar menjadi Anggota? <a href="register.php">daftar</a></p>
    </main>
</body>

</html>