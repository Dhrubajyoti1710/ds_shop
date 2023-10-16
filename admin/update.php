<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Update Product Form</title>
  <style>
	  body {
	  font-family: Arial, sans-serif;
	  margin: 0;
	  padding: 0;
	  background-color: #f5f5f5;
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
	
	.container {
	  max-width: 600px;
	  margin: 50px auto;
	  padding: 20px;
	  background-color: #fff;
	  border: 1px solid #ccc;
	  border-radius: 5px;
	  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	}
	
	h2 {
	  margin-top: 0;
	}
	
	.form-group {
	  margin-bottom: 15px;
	}
	
	label {
	  display: block;
	  font-weight: bold;
	}
	
	input[type="text"],
	input[type="file"],select
	 {
	  width: 100%;
	  padding: 8px;
	  border: 1px solid #ccc;
	  border-radius: 3px;
	}
	
	input[readonly] {
	  background-color: #f5f5f5;
	}
	
	button {
	  display: block;
	  margin-top: 10px;
	  padding: 10px 20px;
	  background-color: #007bff;
	  color: #fff;
	  border: none;
	  border-radius: 3px;
	  cursor: pointer;
	}
	
	button:hover {
	  background-color: #0056b3;
	}

  </style>
</head>
<body>

<?php
 if(isset($_POST["pid"]))
 {
	 $pid=$_POST["pid"];
	 include("connect_db.php");
	 $query="SELECT PNAME,PCATEGORY,PRICE,PIMAGE FROM PRODUCT WHERE PID='$pid';";
	 $result=mysqli_query($con,$query);
	 if(mysqli_num_rows($result)>0)
	 {
		 if($row=mysqli_fetch_array($result))
		 {
			 $pname=$row["PNAME"];
			 $pcategory=$row["PCATEGORY"];
			 $price=$row["PRICE"];
			 $pimage=$row["PIMAGE"];
			 echo "<a href='adminhome.php' id='adminhome'>Admin Home</a>";
             echo "<div class='container'>";
               echo "<h2>Update Product Information</h2>";
               echo "<form action='doUpdate.php' method='post' enctype='multipart/form-data'>";
                   echo "<div class='form-group'>";
						echo "<label for='productID'>Product ID:</label>";
						echo "<input type='text' id='productID' name='pid' value='$pid' readonly>";
            echo "</div>";
			echo "<div class='form-group'>";
              echo "<label for='productName'>Product Name:</label>";
              echo "<input type='text' id='productName' name='pname' value='$pname' required>
      </div>";
            echo "<div class='form-group'>";
              echo "<label for='productCategory'>Product Category:</label>";
               echo "<select  id='pcategory' name='pcategory' required>";
                   echo "<option selected hidden value='$pcategory'>".$pcategory."</option>";
                   echo "<option value='Men'>Men</option>";
                   echo "<option value='Women'>Women</option>";
               echo "</select>";
             echo "</div>";
      echo "<div class='form-group'>";
        echo "<label for='productPrice'>Product Price:</label>";
        echo "<input type='text' id='productPrice' name='price' value='$price' step='0.01' required >
      </div>";
      
        echo "<input type='submit' name='submit' value='Update Product'>";
     echo "</form>";
  echo "</div>";
			 
		 }
	 }
	 mysqli_close($con);
 }
?>






</body>
</html>



