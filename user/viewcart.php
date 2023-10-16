
<?php
        session_start();
        if(!isset($_SESSION['IS_LOGIN']))
        {
            header("Location:userLogin.php");
			die();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Cart</title>
<style>
  
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }
  .search-container {
    text-align: center;
    margin-top: 50px;
  }
  .search-input {
    padding: 10px;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    outline: none;
  }
  .search-button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    outline: none;
    transition: background-color 0.3s ease;
  }
  .search-button:hover {
    background-color: #0056b3;
  }
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

#userhome
  {
	  position:fixed;
	  top:5px;
	  right:10px;
	  font-size:22px;
	  
  }
  #userhome:hover
  {
	  text-decoration:none;
	  font-weight:bolder;
	  color:red;
  }
  .remove-button
{
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
  text-decoration:none;
}
.remove-button:hover
{
	background-color: #0056b3;
}
.order-button
{
  
  padding: 10px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
  text-decoration:none;
  position:absolute;
  margin-left:700px;
  margin-top:50px;
  border-radius:10px;
  height:25px;
  font-size:18px;
}
.order-button:hover
{
	background-color: #0056b3;
	
}

</style>

</head>
<body>
<a href="userhome.php" id="userhome">Continue Shopping</a>

<h1>My Cart</h1>
<?php
	include("connect_db.php");
	
	$email=$_SESSION['IS_LOGIN'];
	$query="SELECT PID,PNAME,PCATEGORY,PRICE,PIMAGE FROM CART WHERE EMAIL='$email';";
					$result=mysqli_query($con,$query);
					if(mysqli_num_rows($result)>0)
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
						while($rows=mysqli_fetch_array($result))
						{
									
											echo "<tr>";
												  echo "<td>".$rows['PID']."</td>";
												  echo "<td>".$rows['PNAME']."</td>";
												  echo "<td>".$rows['PCATEGORY']."</td>";
												  echo "<td>".$rows['PRICE']."</td>";
												  echo "<td><img src='".$rows['PIMAGE']."'/></td>";
												  echo "<td><a href=removecart.php?q=".$rows['PID']." class='remove-button'>Remove</a></td>";
				
					
											echo "</tr>";
									
						}
						echo "</tbody>";
					   echo "</table>";
					   echo "<a href='placeOrder.php' class='order-button'>Place Order</a>";
									
					}
					else
					{
						echo "<h3>>>>>>>>Your cart is empty.To buy a product,at first add the same to your cart by searching...........</h3>";
					}
					mysqli_close($con);
?>


 

				

</body>
</html>
