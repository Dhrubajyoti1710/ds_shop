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

.modify-button {
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
  text-decoration:none;
}

.modify-button:hover {
  background-color: #0056b3;
}
#adminhome
  {
	  position:fixed;
	  top:50px;
	  left:20px;
	  font-size:22px;
  }
  #adminhome:hover
  {
	  text-decoration:none;
	  font-weight:bolder;
	  color:red;
  }

</style>
<title>Delete Product</title>
</head>
<body>
<a href="adminhome.php" id="adminhome">Admin Home</a>
<div class="search-container">
<form method="post">
  <input type="text" name="pid" class="search-input" placeholder="Search by PID..." required>
  <button class="search-button" type="submit" name="submit">Search</button>
</form> 
  <?php
  			include("connect_db.php");
			if(isset($_POST["submit"]))
			{
				$pid=$_POST["pid"];
				$query="SELECT PID,PNAME,PCATEGORY,PRICE,PIMAGE FROM PRODUCT WHERE PID='$pid';";
				$result=mysqli_query($con,$query);
				if(mysqli_num_rows($result)>0)
				{
					if($row=mysqli_fetch_array($result))
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
										echo "<tr>";
											  echo "<td>".$row['PID']."</td>";
											  echo "<td>".$row['PNAME']."</td>";
											  echo "<td>".$row['PCATEGORY']."</td>";
											  echo "<td>".$row['PRICE']."</td>";
											  echo "<td><img src='".$row['PIMAGE']."'/></td>";
											  echo "<form action='delete.php' method='post'>";
											  echo "<td><button type='submit' value='".$row['PID']."' class='modify-button' name='pid'>Delete</button></td>";
											  echo "</form>";
				
				
										echo "</tr>";
								echo "</tbody>";
							echo "</table>";	
					}
				}
				else
				{
					echo "<h3>>>>>>>>Data has not been found...........</h3>";
				}
			}
		?>
</div>
<h1>Product List</h1>
<?php
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
												  echo "<form action='delete.php' method='post'>";
											  echo "<td><button type='submit' value='".$rows['PID']."' class='modify-button' name='pid'>Delete</button></td>";
											  echo "</form>";
				
					
											echo "</tr>";
									
						}
						echo "</tbody>";
								echo "</table>";	
					}
					else
					{
						echo "<h3>>>>>>>>Data has not been found...........</h3>";
					}
?>				

</body>
</html>
