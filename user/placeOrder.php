<?php
        session_start();
        if(!isset($_SESSION['IS_LOGIN']))
        {
            header("Location:userLogin.php");
			die();
        }
?>

 <?php
 $email=$_SESSION['IS_LOGIN'];
 include("connect_db.php");
 $items=0;
 $price=0.00;
 $query="SELECT PRICE FROM CART WHERE EMAIL='$email'";
 $result=mysqli_query($con,$query);
 if(mysqli_num_rows($result)>0)
 {
	 while($rows=mysqli_fetch_array($result))
	 {
		 $items=$items+1;
		 $price=$price+$rows["PRICE"];
	 }
 }
 mysqli_close($con);
 ?>
 
 <?php
 	
		
        
		include("connect_db.php");
		$query="SELECT NAME,ADDRESS FROM USER WHERE EMAIL='$email'";
		$result=mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0)
		{
			if($row=mysqli_fetch_array($result))
			{
				$name=$row["NAME"];
				$address=$row["ADDRESS"];
				
			}
		}
		mysqli_close($con);
		include("connect_db.php");
		
		$query="INSERT INTO ORDERS(EMAIL,NAME,ADDRESS,ITEMS,PRICE) VALUES('$email','$name','$address',$items,$price)";
		
		$result=mysqli_query($con,$query);
		mysqli_close($con);
		
		
	include("connect_db.php");
		$query="SELECT INVOICE_NO FROM ORDERS WHERE EMAIL='$email'";
		$result=mysqli_query($con,$query);
		$invoice_no="";
		if(mysqli_num_rows($result)>0)
		{
			while($rows=mysqli_fetch_array($result))
			{
				$invoice_no=$rows["INVOICE_NO"];
				
				
			}
		}
		mysqli_close($con);	
		
	
 ?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
		#userhome
  {
	  position:fixed;
	  top:5px;
	  right:10px;
	  font-size:22px;
	  
  }
  #userhome:hover
  {
	  text-decoration:none;
	  font-weight:bolder;
	  color:red;
  }
        .invoice {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            font-size: 24px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
        }
        .invoice-details .left {
            flex: 1;
        }
        .invoice-details .right {
            flex: 1;
            text-align: right;
        }
        .invoice-items {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }
        .invoice-items th, .invoice-items td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
		h3
       {
	  position:fixed;
	  bottom:280px;
	  left:150px;
	  font-family:"Comic Sans MS", cursive;
	  font-size:24px;
       }

    </style>
</head>
<body>
<a href="userhome.php" id="userhome">User Home</a>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Invoice</h1>
        </div>
        <div class="invoice-details">
            <div class="left">
                <p>Invoice Number: <?php echo $invoice_no;?></p>
                <p>Invoice Date: September 8, 2023</p>
            </div>
            <div class="right">
                <p>Bill To:</p>
                <address>
                    <?php echo $name;?><br>
                    <?php echo $address ?><br>
                </address>
            </div>
        </div>
        <table class="invoice-items">
            <thead>
                <tr>
                    
                    <th>Quantity</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $items ?></td>
                    <td><?php echo "Rs.".$price ?></td>
                    
                </tr>
            </tbody>
        </table>
        <div class="invoice-total">
            <p>Total: <?php echo "Rs.".$price ?></p>
        </div>
    </div>
</body>
</html>

<?php
include('smtp/PHPMailerAutoload.php');
$body="<b>Hi! $name....Your order details are shown below<br>Invoice No : $invoice_no<br>Quantity : $items<br>Total Price : $price<br>Delivery Address : $address</b>";

echo smtp_mailer($email,'Order Details',$body);
function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "dsshop928@gmail.com";
	$mail->Password = "dxeqccaiqnsofgch";
	$mail->SetFrom("dsshop928@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		return '<h3>Invoice Sent to your registered Email Id</h3>';
	}
}
?>

 
 
 
 
 
 

