<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>PLM Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
	<script src="lib/sweetalert2/sweetalert2.min.js"></script>
	<link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
	<script>
      function error(){
        swal(
          'Oops...',
          'You are not log in. Would you like to?',
          'error'
        ).then((result) => {
			setTimeout(function() {
				location="../index.php";
			}, 100);
		})
      }
	  function success()
	  {
		  swal(
			  'Logout!',
			  'You have been logged out.',
			  'success'
		  ).then((result) => {
			setTimeout(function() {
				location="../index.php";
			}, 100);
		})
	  }
    </script>
</head>
<body>
<?php
	//check if user if signed in
	if($_SESSION['signed_in'] == false)
	{
		echo '<script>error();</script>';
	}
	else
	{
		//unset all variables
		$_SESSION['signed_in'] = NULL;
		$_SESSION['username'] = NULL;
		$_SESSION['password']   = NULL;
		session_destroy();
		echo '<script>success();</script>';
	}
?>
</body>
</html>