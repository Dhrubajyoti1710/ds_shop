<!DOCTYPE html>
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
			
			$target_dir="uploadfiles/";
			$basename_file=basename($_FILES["pimage"]["name"]);
		    $fixed_name="ds_shop";
			
			$imageFileType=strtolower(pathinfo($basename_file,PATHINFO_EXTENSION));
			$target_file=$target_dir.$fixed_name.'.'.$imageFileType;
			
			$fixed_name_len=strlen($fixed_name);
			$imageFileType_len=strlen($imageFileType)+1;
			
			$image_file_no=substr($basename_file,$fixed_name_len,(strlen($basename_file)-$imageFileType_len));
			
			$image_file_no=strrev($image_file_no);
			$image_file_no=substr($image_file_no,$imageFileType_len,strlen($image_file_no));
			$image_file_no=strrev($image_file_no);
			echo($image_file_no);
			
			
			$uploadOK=1;
		    $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			
			$check=getimagesize($_FILES["pimage"]["tmp_name"]);
			if($check!==false)
			{
				//echo "File is an image-".$check["mime"].".";
				$uploadOK=1;
			}
			else
			{
				echo "File is not an image.";
				$uploadOK=0;
			}
			
			//CHECK IF FILE ALREADY EXISTS
		
			/*if(file_exists($target_file))
			{
				echo "Sorry,file already exists.";
				$uploadOK=0;
			}*/
			
			//check file size
			/*if($_FILES["pimage"]["size"]>500000)
			{
				echo "Sorry,your file is too large.";
				$uploadOK=0;
			}*/
			
			//allow certain file formats
			
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
			{
				echo "Sorry,only JPG,JPEG,PNG & GIF files are allowed.";
				$uploadOK=0;
			}
			
			//check if $uploadOK is set to 0 by an error
			
			if($uploadOK==0)
			{
				echo "Sorry,your file was not uploaded. ";
				//if everything is ok,try to upload file
			}
			else
			{
				$iname=$_FILES["pimage"]["name"];
				$a=explode(".",$iname);
				$extension=$a[2];
				$i=1;
				$name="image".$i.$extension;
				$_FILES["pimage"]["name"]=$name;			
				
				if(move_uploaded_file($_FILES["pimage"]["tmp_name"],$target_file))
				{
					echo "The file ".htmlspecialchars(basename($_FILES["pimage"]["name"]))." has been uploaded.";
					$query="INSERT INTO PRODUCT(PNAME,PCATEGORY,PRICE,PIMAGE) VALUES('$pname','$pcategory',$price,'$target_file');";
					$result=mysqli_query($con,$query);
					if($result)
					{
						echo "Product inserted into database...<br>";
						
					}
				}
				else
				{
					echo "Sorry,there was an error uploading product.";
				}
			}
	
			mysqli_close($con);	
			
		}
	?>
</body>
</html>