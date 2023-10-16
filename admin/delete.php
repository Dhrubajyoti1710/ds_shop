<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Delete</title>
<style>
#deleteproduct
  {
	  position:fixed;
	  top:50px;
	  left:20px;
	  font-size:22px;
  }
  #deleteproduct:hover
  {
	  text-decoration:none;
	  font-weight:bolder;
	  color:red;
  }
</style>
</head>

<body>
<?php

		include("connect_db.php");
		$pid=$_POST["pid"];
		
		$query="DELETE FROM PRODUCT WHERE PID='$pid' ";
		$result=mysqli_query($con,$query);
		if($result)
		{
			header("Location:deleteproduct.php");
		}
		else
		{
			echo "<h3>Data has not been deleted.....</h3>";
			echo "<a href='deleteproduct' id='deleteproduct'>Go to the Delete Product Page</a>";
		}
		
		mysqli_close($con);
		
	

?>
</body>
</html>