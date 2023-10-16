
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
<title>Home Page</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
	
	
  }
  #sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 300px;
    height: 100%;
    background-color: #333;
    color: #fff;
    padding: 20px;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
  }
  
    ul {
    margin: 0;
    padding: 0;
  }

  .menu-bar {
    background-color: #007bff;
    color: white;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 10px 0;
  }

  .menu-item {
    text-decoration: none;
    color: white;
    padding: 10px 20px;
    border-bottom: 2px solid transparent;
    transition: border-color 0.3s;
  }

  .menu-item:hover {
    border-bottom-color: white;
  }
  #content {
    margin-left: 320px; /* Adjust based on sidebar width and any desired gap */
    padding: 20px;
	background-image:url(bg.jpg);
	height:625px;
	background-position:center;
	background-repeat:no-repeat;
	background-size:cover;
  }
  h2
  {
	margin-left:50px;  
  }
  .search-box {
    width:93%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 10px;
    background-color:white;
    color: #fff;
  }
  .category-select {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
	margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
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

.addtocart-button {
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
  text-decoration:none;
}

.addtocart-button:hover {
  background-color: #0056b3;
}
.placeorder-button
{
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
  transition: background-color 0.3s ease;
  text-decoration:none;
}
.placeorder-button:hover
{
	background-color: #0056b3;
}
</style>
</head>
<body>
  <div id="sidebar">
    <form method="post">
    <h3>Search By Name</h3>
    <input type="text" name="pname" class="search-box" placeholder="Search by name" required>
    <button class="search-button" type="submit" name="submit1">Go</button>
    </form>
    
    
    <form method="post">
    <h3>Search By Category</h3>
     <select class="category-select" name="pcategory" required>
      <option selected hidden>All Categories</option>
      <option value="Men">Men</option>
      <option value="Women">Women</option>
    </select>
    <button class="search-button" type="submit" name="submit2">Go</button>
    </form>
  </div> 
  
  
  


<div class="menu-bar">
  
  <a href="viewcart.php" class="menu-item">View Cart</a>
  <a href="logout.php" class="menu-item">Logout</a>
 </div>
 
 <div id="content">

  
  <!--user name section-->
  <?php
    $email=$_SESSION['IS_LOGIN'];
    $con=mysqli_connect('localhost','root','','ds_shop');
	$query="SELECT NAME FROM USER WHERE EMAIL='$email'";
	$result=mysqli_query($con,$query);
	if($row=mysqli_fetch_array($result))
	{
		$name=$row["NAME"];
	}
	echo"<h2>Welcome ".$name."........</h2>"; 
	mysqli_close($con);
	?>
  
  
  
  
  
  <!-- product show section by name-->
  <?php
  if(isset($_POST["submit1"]))
  {
	$pname=$_POST["pname"]; 
	
		
	include("connect_db.php");	
	$query="SELECT PID,PNAME,PCATEGORY,PRICE,PIMAGE FROM PRODUCT WHERE PNAME='$pname'";
	
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
							
		while($row=mysqli_fetch_array($result))
		{ 
				            echo "<tr>";
			 
								  echo "<td>".$row['PID']."</td>";
								  echo "<td>".$row['PNAME']."</td>";
								  echo "<td>".$row['PCATEGORY']."</td>";
								  echo "<td>".$row['PRICE']."</td>";
								  echo "<td><img src='../admin/".$row['PIMAGE']."' /></td>";
								  echo "<form action='addtocart.php' method='post'>";
								  echo "<td><button type='submit' value='".$row['PID']."' class='addtocart-button' name='pid'>Add to Cart</button></td>";
								  echo "</form>";
								  
								  
	                         echo "</tr>";
	
				
		}
					
					echo "</tbody>";
				echo "</table>";
					
		
	}
	else
	{
		
		echo "<h3>>>>>>>>Product has not been found...........</h3>";
		
	}
	mysqli_close($con);
  }
  ?>
  
  
  
  <!-- product show section by category-->
  <?php
  if(isset($_POST["submit2"]))
  {
	$pcategory=$_POST["pcategory"];  
	$query="SELECT PID,PNAME,PCATEGORY,PRICE,PIMAGE FROM PRODUCT WHERE PCATEGORY='$pcategory'";
	include("connect_db.php");
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
							
		while($row=mysqli_fetch_array($result))
		{
				         
			             echo "<tr>";
								  echo "<td>".$row['PID']."</td>";
								  echo "<td>".$row['PNAME']."</td>";
								  echo "<td>".$row['PCATEGORY']."</td>";
								  echo "<td>".$row['PRICE']."</td>";
								  echo "<td><img src='../admin/".$row['PIMAGE']."' /></td>";
								  echo "<form action='addtocart.php' method='post'>";
								  echo "<td><button type='submit' value='".$row['PID']."' class='addtocart-button' name='pid'>Add to Cart</button></td>";
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
	mysqli_close($con);
  }
  

  ?>
  
  </div>
  
  
  
</body>
</html>
