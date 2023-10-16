-<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product</title>
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

  .login-container {
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

  input,select {
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

  .file-input {
    display: none;
  }

  .file-label {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .file-label:hover {
    background-color: #0056b3;
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
<div class="login-container">
  <h2>Add Product</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="input-group">
      <label for="pname">Product Name</label>
      <input type="text" id="pname" name="pname" required>
    </div>
    <div class="input-group">
      <label for="pcategory">Product Category</label>
      <select  id="pcategory" name="pcategory" required>
             <option selected hidden>-Select Category-</option>
             <option value="Men">Men</option>
             <option value="Women">Women</option>
      </select>
    </div>
    <div class="input-group">
      <label for="price">Product Price</label>
      <input type="text" id="price" name="price" step="0.01" required>
    </div>
    <div class="input-group">
      <label for="pimage">Product Image</label>
      <input type="file" id="pimage" name="pimage" class="file-input" accept="image/*" required>
      <label for="pimage" class="file-label">Choose Image</label>
    </div>
    <button type="submit" name="submit">Add Product</button>
  </form>
    
    
    
    
    
    <?php
		include("connect_db.php");
		if(isset($_POST["submit"]))
		{
				$pname=$_POST["pname"];
				$pcategory=$_POST["pcategory"];
				$price=$_POST["price"];
				$pimage=$_FILES["pimage"];
				$imagename=$pimage["name"];
				$fixed_image_name="ds_shop";
				
				$target_dir="uploadfiles/";
				$target_file=$target_dir.$imagename;
				$uploadOK=1;
				$imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			
			//allow certain file formats
			
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
				{
					echo "Sorry,only JPG,JPEG,PNG & GIF files are allowed.";
					$uploadOK=0;
				}
			
			//check if $uploadOK is set to 0 by an error
			
				if($uploadOK==0)
				{
					echo "<h6>Sorry,your file was not uploaded<h6>.<br> ";
					
				}
				else
				{
					$query="SELECT PIMAGE FROM PRODUCT;";
					$result=mysqli_query($con,$query);
					if(mysqli_num_rows($result)==0)
					{
						$imagename="ds_shop1.".$imageFileType;
						$target_file=$target_dir.$imagename;
						if(move_uploaded_file($pimage["tmp_name"],$target_file))
					    {
								$query="INSERT INTO PRODUCT(PNAME,PCATEGORY,PRICE,PIMAGE) VALUES('$pname','$pcategory',$price,'$target_file');";
								$result=mysqli_query($con,$query);
								if($result)
								{
									echo "<h2>Product inserted into database...</h2><br>";
									
								}
								else
								{
									echo "<h2>Product is not inserted into database...</h2><br>";
								}
					     }
					}
					else
					{
						$path="";
						while($rows=mysqli_fetch_array($result))
						{
							$path=$rows["PIMAGE"];
						}
						$path_arr=explode("/",$path);
						$imagename=$path_arr[1];
						$imagename_arr=explode(".",$imagename);
						$iname=$imagename_arr[0];
						
					//	$imageFileType_len=strlen($imageFileType)+1;
					
						$iname_len=strlen($iname);
						
						$image_file_no=substr($iname,7,($iname_len - 7));
						
						$i=intval($image_file_no);
						
						$i++;
						
						$imagename=$fixed_image_name.$i.".".$imageFileType;
						$target_file=$target_dir.$imagename;
						//if everything is ok,try to upload file
						if(move_uploaded_file($pimage["tmp_name"],$target_file))
						{
							$query="INSERT INTO PRODUCT(PNAME,PCATEGORY,PRICE,PIMAGE) VALUES('$pname','$pcategory',$price,'$target_file');";
							$result=mysqli_query($con,$query);
							if($result)
							{
								echo "<h2>Product inserted into database...</h2><br>";
								
							}
							else
							{
								echo "<h2>Product is not inserted into database...</h2><br>";
							}
						}
					}
			    }

			mysqli_close($con);	
			
		}
	?>
    
</body>
</html>