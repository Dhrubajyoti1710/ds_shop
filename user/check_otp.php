<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User Login Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
	.field_error{color:red;}
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
<div class="login-form">
    <form  method="post">
        <h2 class="text-center">Log in</h2>  
        <div class="form-group second_box">
            <input type="text" id="otp" name="otp" class="form-control" placeholder="OTP" required="required">
			<span id="otp_error" class="field_error"></span>
        </div>
        <div class="form-group second_box">
            <button type="submit" name="submit" class="btn btn-primary btn-block" >Submit OTP</button>
        </div> 
     </form>
 </div>
 
 </body>
 </html>
          
<?php
	if(isset($_POST["submit"]))
	{
		$otp=$_POST['otp'];
		session_start();
		include("connect_db.php");
		
		$email=$_SESSION['EMAIL'];
		$res=mysqli_query($con,"select * from user where email='$email' and otp='$otp'");
		$count=mysqli_num_rows($res);
		mysqli_close($con);
		if($count>0){
			include("connect_db.php");
			mysqli_query($con,"update user set otp='' where email='$email'");
			$_SESSION['IS_LOGIN']=$email;
			mysqli_close($con);
			header("location:userhome.php");
		}else{
			echo "Enter valid otp";
		}
	}
?>