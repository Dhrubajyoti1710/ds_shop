<?php
	session_start();
	if(!isset($_SESSION['adminid']))
	{
		header("Location:adminlogin.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Home Page</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
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

  .content {
    padding: 20px;
  }
</style>
</head>
<body>
<div class="menu-bar">
  <a href="addproduct.php" class="menu-item">Add Product</a>
  <a href="modifyproduct.php" class="menu-item">Modify Product</a>
  <a href="deleteproduct.php" class="menu-item">Delete Product</a>
  <a href="viewcart.php" class="menu-item">View Cart</a>
  <a href="changepassword.php" class="menu-item">Change Password</a>
  <a href="logout.php" class="menu-item">Logout</a>
</div>
<div class="content">
  <h1>Welcome to our Admin Home Page!</h1>
  
</div>
</body>
</html>