<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Database Connection</title>
</head>

<body>
<?php
			define('DB_HOST','localhost');
			define('DB_NAME','ds_shop');
			define('DB_USER','root');
			define('DB_PASSWORD','');
		
			$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	?>		
</body>
</html>