<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Do Update</title>
</head>

<body>
<?php

		include("connect_db.php");
		$pid=$_POST["pid"];
		$pname=$_POST["pname"];
		$pcategory=$_POST["pcategory"];
		$price=$_POST["price"];
		
		
		$query="UPDATE PRODUCT SET PNAME='$pname',PCATEGORY='$pcategory',PRICE='$price' WHERE PID='$pid' ";
		echo("<br>".$query."<br>");
		$result=mysqli_query($con,$query);
		if($result)
		{
			echo "<h3>Data has been updated successfully.....</h3>";
		}
		else
		{
			echo "<h3>Data has not been updated.....</h3>";
		}
		
		mysqli_close($con);
		
		
header("Location:modifyproduct.php");
?>
</body>
</html>