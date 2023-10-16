
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
<title>Add to Cart</title>
</head>

<body>
 <?php
  	if(isset($_POST["pid"]))
	{
		session_start();
		$email=$_SESSION['IS_LOGIN'];
		include("connect_db.php");
		$pid=$_POST["pid"];
		$query="SELECT PNAME,PCATEGORY,PRICE,PIMAGE FROM PRODUCT WHERE PID='$pid'";
		$result=mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0)
		{
			if($row=mysqli_fetch_array($result))
			{
				$pname=$row["PNAME"];
				$pcategory=$row["PCATEGORY"];
				$price=$row["PRICE"];
				$pimage=$row["PIMAGE"];
				$image="../admin/".$pimage;
			}
		}
		$query="INSERT INTO CART(EMAIL,PID,PNAME,PCATEGORY,PRICE,PIMAGE) VALUES('$email','$pid','$pname','$pcategory',$price,'$image')";
		$result=mysqli_query($con,$query);
		mysqli_close($con);
		if($result)
		{
			header("Location:viewcart.php");
		}
		else
		{
			echo "<h3>Product is not added to Cart.....</h3>";
		}
	}
  ?>
</body>
</html>