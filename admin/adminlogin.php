<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .admin-login-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 400px;
    max-width: 90%;
    text-align: center;
  }

  h2 {
    margin-bottom: 20px;
    color: #333;
  }
  h3
  {
	  position:fixed;
	  bottom:80px;
  }

  .input-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-size: 14px;
    margin-bottom: 5px;
    color: #555;
    text-transform: uppercase;
  }

  input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.3s;
  }

  input:focus {
    border-color: #007bff;
  }

  button {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  button:hover {
    background-color: #0056b3;
  }
  #home
  {
	  position:fixed;
	  top:10px;
	  left:10px;
	  font-size:22px;
  }
  #home:hover
  {
	  text-decoration:none;
	  font-weight:bolder;
	  color:red;
  }
  #info
  {
	  position:fixed;
	  margin-top:400px;
	  font-size:24px;
	  font-family:"Comic Sans MS", cursive;
  }
</style>
</head>
<body>
<a href="../index.html" id="home">Home</a>

<div class="admin-login-container">
  <h2>Admin Login</h2>
  <form action="" method="post">
    <div class="input-group">
      <label for="adminid">Admin ID</label>
      <input type="text" id="adminid" name="adminid" required>
    </div>
    <div class="input-group">
      <label for="password">Admin Password</label>
      <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" name="submit">Login</button>
  </form>
</div>
<div id="info"><strong><i>Initially Admin Id and Password both are set to "admin".You can change Admin Password after login.....</i></strong></div>


<?php
	
	include("connect_db.php");
	
	if(isset($_POST["submit"]))
	{
		$adminid=$_POST["adminid"];
		$password=$_POST["password"];
		$query="SELECT PASSWORD FROM ADMIN WHERE adminid='$adminid';";
		$result=mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0)
		{
			if($row=mysqli_fetch_array($result))
			{
				$pswrd=$row['PASSWORD'];
				if($password == $pswrd)
				{
					session_start();
					$_SESSION["adminid"]=$adminid;
			        header("Location:adminhome.php");
				}
				else
				{
					echo "<h3>You have entered wrong ID and/or Password....</h3>";
				}
			}
		}
		else
		{
			echo "<h3>You have entered wrong ID and/or Password....</h3>";
		}
	}
	mysqli_close($con);
?>
</body>
</html>
