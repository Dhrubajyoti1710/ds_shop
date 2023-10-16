<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  th {
    background-color: #f2f2f2;
    font-weight: bold;
  }
  tr:hover {
    background-color: #f5f5f5;
  }
  img {
    max-width: 50px;
    max-height: 50px;
  }
#adminhome
  {
	  position:fixed;
	  top:10px;
	  right:10px;
	  font-size:22px;
  }
  #adminhome:hover
  {
	  text-decoration:none;
	  font-weight:bolder;
	  color:red;
  }

</style>
<title>View Cart</title>
</head>
<body>
<a href="adminhome.php" id="adminhome">Admin Home</a>
		
<h1>Product List</h1>
<?php
    include("connect_db.php");
	$query1="SELECT PID,PNAME,PCATEGORY,PRICE,PIMAGE FROM PRODUCT;";
					$result1=mysqli_query($con,$query1);
					if(mysqli_num_rows($result1)>0)
					{
						echo "<table>";
									echo "<thead>";
										echo "<tr>";
											echo "<th>Product ID</th>";
											echo "<th>Product Name</th>";
											echo "<th>Product Category</th>";
											echo "<th>Price</th>";
											echo "<th>Image</th>";
										echo "</tr>"; 
									echo "</thead>";
									echo "<tbody>"; 
						while($rows=mysqli_fetch_array($result1))
						{
									
											echo "<tr>";
												  echo "<td>".$rows['PID']."</td>";
												  echo "<td>".$rows['PNAME']."</td>";
												  echo "<td>".$rows['PCATEGORY']."</td>";
												  echo "<td>".$rows['PRICE']."</td>";
												  echo "<td><img src='".$rows['PIMAGE']."'/></td>";
	                                        echo "</tr>";
									
						}
						           echo "</tbody>";
						echo "</table>";	
					}
					else
					{
						echo "<h3>>>>>>>>Product has not been found...........</h3>";
					}
?>				

</body>
</html>
