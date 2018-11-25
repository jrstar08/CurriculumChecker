<!-- php -->
<?php
	include ('connect.php');
	if(isset($_POST['login']))
	{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = mysqli_query($conn, "SELECT * FROM users WHERE login='$username' AND password='$password'");
	
	if($username == 'admin' && $password == 'admin'){
		$_SESSION['signed_in'] = true;
		header("location: admin/home.php");        
	}
	
	if(mysqli_num_rows($query)>0)
	{
		$result = mysqli_fetch_row($query);
		$_SESSION['signed_in'] = true;
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$query8 = "update studyplan_template set current_year = 0, current_sem = 0 where curriculumid = 200933";
		$result8 = mysqli_query($conn, $query8);

		if($result[4] == 1)
		header("location: adviser/home.php");
		else if ($result[4] == 5){
		$query = mysqli_query($conn, "select registrationcode from studentterms where studentid = '$result[1]' order by aysem desc limit 1");
		$result = mysqli_fetch_row($query);
		if($result[0] == 'I')
			header("location: student/home.php");
		else
			header("location: student/home1.php");
		}
		else
		echo "<script> error(); </script>";
	}
	else
		echo "<script> error(); </script>";
	}
?>
<!-- /php -->
<!DOCTYPE html>
<html lang="EN">
<head>
<title>PLM Curriculum Checker</title>
    <link rel="shortcut icon" href="lib/plmlogo.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
	<meta name="keywords" content="Flick Widget Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
	/>
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- fonts -->
	<!-- <link href="//fonts.googleapis.com/css?family=Cuprum:400,400i,700,700i" rel="stylesheet"> -->
	<!-- /fonts -->
	<!-- css -->
	<link rel="stylesheet" href="lib/bootstrap.min.css">
    <script src="lib/sweetalert2/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="lib/sweetalert2/sweetalert2.min.css">
	<link href="lib/css/font-awesome.css" rel="stylesheet" type="text/css" media="all" />
	<link href="lib/css/login-style.css" rel='stylesheet' type='text/css' media="all" />
	<style>
		.content-w3ls{
			height: 100vh;
			margin: 0;
			padding: 0;
		}
	</style>
	<!-- /css -->
	<!-- js -->
	<script>
      function error(){
        swal(
          'Invalid',
          'Sorry, username or password not found!',
          'error'
        )
      }
    </script>
    <script>
      function numbersonly(){
        $.bootstrapGrowl("Only alphanumerics are accepted in this field..", {
        ele: 'body', // which element to append to
        type: 'info', // (null, 'info', 'danger', 'success')
        offset: {from: 'top', amount: 20}, // 'top', or 'bottom'
        align: 'right', // ('left', 'right', or 'center')
        width: 320, // (integer, or 'auto')
        delay: 3500, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
      }
    </script>
	<!-- /js -->
</head>

<body>
	<div class="content-w3ls">
		<div class="left-grid">
			<header>
				<h1 class="Flick-grid">
					<a style="padding-left: 0; padding-right: 0;">Pamantasan ng lungsod ng maynila</a>
				</h1>
			</header>
			<div class="sub-grid">
				<h2>Curriculum Checker</h2>
				<!-- <p>Join us for FREE to get instant email updates!</p> -->
				<div class="subscribe-w3ls">
					<form method="post">
						<div class="form-group1">
							<input type="text" id="userid" name="username" placeholder="Enter Your Username" maxlength="11" required autofocus>
						</div>
						<div class="form-group1">
							<input type="password" id="password" name="password" placeholder="Enter Your Password" maxlength="20" required>
						</div>
						<div class="form-group2">
							<button type="submit" class="btn btn-outline btn-lg" name="login">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
							</button>
						</div>
						<div class="clear"></div>
					</form>
				</div>
				<ul class="social-icons3">

					<li>
						<a href="#" class="s-iconfacebook">
							<span class="fa fa-facebook" aria-hidden="true"></span>
						</a>
					</li>
					<li>
						<a href="#" class="s-icontwitter">
							<span class="fa fa-twitter" aria-hidden="true"></span>
						</a>
					</li>
					<li>
						<a href="#" class="s-icondribbble">
							<span class="fa fa-dribbble" aria-hidden="true"></span>
						</a>
					</li>
					<li>
						<a href="#" class="s-iconbehance">
							<span class="fa fa-github" aria-hidden="true"></span>
						</a>
					</li>
				</ul>
				<div class="agileits-w3layouts-copyright">
					<p class="w3ls-copyright">© 2018 &nbsp;PLM-SQUADCORE 2018. All rights reserved
					</p>
				</div>
			</div>
		</div>
		<div class="right-grid">
		</div>
	</div>
	
	<!-- script -->
	<script src="lib/jquery.min.js"></script>
	<script src="lib/bootstrap.min.js"></script>
	<script src="lib/jquery.bootstrap-growl.js"></script>
	<script type="text/javascript">
	$(window).load(function(){
		$('.form-group input').on('focus blur', function (e) {
			$(this).parents('.form-group').toggleClass('active', (e.type === 'focus' || this.value.length > 0));
		}).trigger('blur');
	});
	</script>
	<script>
	$(document).ready(function () {
		//called when key is pressed in textbox
		$("#userid").keypress(function (e) {
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && !(e.which >= 48 && e.which <= 57) && !(e.which >= 65 && e.which <= 90) && !(e.which >= 97 && e.which <= 122)) {
			//display error message
			// alert('heh');
			numbersonly();
			$("#errmsg").html("Digits Only").show().fadeOut("slow");
					return false;
		}
		});
	});
	</script>
	<!-- /script -->
</body>

</html>