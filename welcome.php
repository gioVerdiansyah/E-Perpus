<?php
session_name("SESSILGN");
session_start();
if (!isset($_SESSION["login-user"]) && !isset($_COOKIE["UUsSRlGn=thORoe"]) && !isset($_COOKIE["UDsSRlGn=thORue"])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome User~</title>
</head>

<body>
    <h1>Hello</h1>
</body>

</html>