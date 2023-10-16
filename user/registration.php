<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Registration</title>
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
</style>
</head>

<body>
<a href="../index.html" id="home">Home</a>
<div class="admin-login-container">
  <h2>User Registration</h2>
  <form action="" method="post">
    <div class="input-group">
      <label for="username">Name</label>
      <input type="text" id="username" name="name" required>
    </div>
    <div class="input-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
    </div>
    
    <div class="input-group">
      <label for="address">Address</label>
      <input type="text" id="address" name="address" required>
    </div>
    
    <button type="submit" name="submit">Register</button>
  </form>
</div>

<?php
	if(isset($_POST["submit"]))
	{
		$name=$_POST["name"];
		$email=$_POST["email"];
		$address=$_POST["address"];
		include("connect_db.php");
		$query="SELECT * FROM USER WHERE EMAIL='$email'";
		$result=mysqli_query($con,$query);
		mysqli_close($con);
		if(mysqli_num_rows($result)>0)
		{
			echo "<h3>This Email Id already exists</h3>";
		}
		else
		{
			include("connect_db.php");
			$query="INSERT INTO USER(NAME,EMAIL,ADDRESS) VALUES('$name','$email','$address')";
			$result=mysqli_query($con,$query);
			mysqli_close($con);
			if($result)
			{
				header("Location:userLogin.php");
			}
			
		}
	}
?>
</body>
</html>