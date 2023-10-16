<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
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

  .change-password-container {
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
  a
  {
	  position:fixed;
	  top:50px;
	  left:20px;
	  font-size:22px;
  }
  a:hover
  {
	  text-decoration:none;
	  font-weight:bolder;
	  color:red;
  }
</style>
</head>
<body>
<a href="adminhome.php">Admin Home</a>
<div class="change-password-container">
  <h2>Change Password</h2>
  
   <form method="post">
    <div class="input-group">
      <label for="oldpassword">Old Password</label>
      <input type="password" id="oldpassword" name="oldpassword" required>
    </div>
    <div class="input-group">
      <label for="newpassword">New Password</label>
      <input type="password" id="newpassword" name="newpassword" required>
    </div>
    <div class="input-group">
      <label for="confirmpassword">Confirm Password</label>
      <input type="password" id="confirmpassword" name="confirmpassword" required>
    </div>
    <button type="submit" name="submit">Change Password</button>
  </form>
</div>
    
    <?php
	include("connect_db.php");
    ?>
    
    <?php
		if(isset($_POST["submit"]))
		{
			$oldpassword=$_POST["oldpassword"];
			$newpassword=$_POST["newpassword"];
			$confirmpassword=$_POST["confirmpassword"];
			
				if($newpassword==$confirmpassword)
				{
					$query="UPDATE ADMIN SET PASSWORD='$newpassword' WHERE PASSWORD='$oldpassword';";
					$result=mysqli_query($con,$query);
					$query="SELECT * FROM ADMIN WHERE PASSWORD='$newpassword';";
					$result=mysqli_query($con,$query);
					if(mysqli_num_rows($result)>0)
					{
						header("Location:adminlogin.php");
					}
					else
				    {
					    echo "<h2>You have entered wrong old password....</h2>";
				    }
				}
				else
				{
					echo "<h2>New password and Confirm password must be same....</h2>";
				}
				
			
		}
	?>
    <?php	
		mysqli_close($con);
	?>
</body>
</html>