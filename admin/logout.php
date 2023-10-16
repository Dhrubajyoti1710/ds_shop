<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Logout Page</title>
</head>

<body>
<?php
session_start();
unset($_SESSION['adminid']);
session_destroy();
header("Location:../index.html");
die();
?>
</body>
</html>