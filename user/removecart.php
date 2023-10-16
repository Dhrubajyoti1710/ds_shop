
<?php
        session_start();
        if(!isset($_SESSION['IS_LOGIN']))
        {
            header("Location:userLogin.php");
			die();
        }
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Remove</title>
</head>

<body>

<?php
 
 $pid=$_GET["q"];
 session_start();
 $email=$_SESSION['IS_LOGIN'];
 include("connect_db.php");
 $query="DELETE FROM CART WHERE EMAIL='$email' AND PID='$pid'";
 $result=mysqli_query($con,$query);
 mysqli_close($con);
 if($result)
 {
	 header("Location:viewcart.php");
 }
 
 ?>
</body>
</html>