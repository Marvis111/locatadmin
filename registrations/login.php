<?php
	include '../controllers/server.php';

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refesh" content="3">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="Keywords" content=" ">
	<meta name="description" content="">
	<!-- js links -->
	<script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/jquery/jquery.js"></script>
	<script type="text/javascript" src="../assets/jquery/jquery-ui.js">
	</script>
	<script type="text/javascript" src="../assets/jquery/jquery-ui.min.js"></script>
	
	<!--css links -->
	<link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="../assets/jquery/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../assets/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/w3.css">
	<link href="assets/css/style.css" rel="stylesheet">
	<!-- bootstrap -->
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/icomoon/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/login.css">


	<title>INQUISITIVE</title>
</head>
<body>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="../index.html">LOCART</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar" style="margin-right: 20px;">
    <ul class="navbar-nav">
       <li class="nav-item">
        <a class="nav-link" href=""><i class="icon-home"></i> Home</a>
      </li> 
       <li class="nav-item">
        <a class="nav-link" href="#"><i class="icon-message"></i>News</a>
      </li>     
       <li class="nav-item">
        <a class="nav-link" href="login.php"><i class="icon-person"></i> Login</a>
      </li>   
    </ul>
  </div>  
</nav>
<section class="section-hero">
<div class="formDiv">
	<!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item" style="width: 50% !important">
      <a class="nav-link active"  data-toggle="tab" href="#home">Login as Admin</a>
    </li>
    <li class="nav-item" style="width: 50% !important">
      <a class="nav-link" data-toggle="tab" href="#menu1">Login as Customer</a>
    </li>
 
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
   		<div class="form" style="padding-bottom: 20px;">

	<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" >
		<?php 
			include '../controllers/errors.php';
		 ?>
  <label for="email">Admin Id:</label>
  <input type="number" name="adminId" class="form-control" id="email">
  <label for="pwd">Password:</label>
  <input type="password" name="adminPassword" class="form-control" id="pwdd">
  <button type="submit" name="admin_Login" class="btn btn-primary formSubmit">Login</button>
  
</form>
		</div>
	


    
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
     <div class="form">
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
			<div class="err"></div>
  <label for="email">Email address:</label>
  <input type="email" name="customerEmail" class="customerEmail form-control" class="form-control" id="email">
  <label for="pwd">Password:</label>
  <input type="password" name="customerPwd" class="customerPwd form-control" class="form-control" id="pwd">
  <button type="button" name="customerLogin"  class="btn btn-primary formSubmit customerLogin">Login</button>
  
</form>
		</div>
		<div class="register">
			<p>Dont have an account? <a href="signup.php">Register</a></p>
		</div>
    </div>
    
  </div>
</div>



</div>
</section>
<script type="text/javascript">
	$(document).ready(function(){


	});

function userLogin(){
		var customerEmail = $('.customerEmail').val();
		var customerPwd = $('.customerPwd').val();
		errorArray = [];
		if (customerPwd == "") {
			errorArray.push('Password is required');
		}
		if (customerEmail == "") {
			errorArray.push('Email is required');
		}
		
		if (errorArray.length > 0) {
			$('.err').html("<div class='alert alert-danger' style='width: 98%;margin: 1px auto'> </div> ");
			for (var i = 0; i < errorArray.length; i++) {
				$('.alert-danger').append("<strong>"+errorArray[i]+"</strong><br>");
			}
		}else{
			var loginDetails = [customerEmail,customerPwd];
			$.ajax({
				url:'../controllers/customer_login.php',
				method:'POST',
				data:{customerEmail,customerPwd},
				success:function(error){
					if (error !== "") {
						$('.err').html("<div class='alert alert-danger' style='width: 98%;margin: 1px auto'><strong> "+error+"</strong> </div> ");
					}else{
						window.location.assign('../customers/index.php');
					}
					
				}

			})
		}


	};
	/// WHEN A USER USES THE ENTER KEY..ew
	$(document).on('keypress',function(e){
		if (e.keyCode == 13) {
			userLogin();
		}
	})
// or click the login btn
	$(document).on('click','.customerLogin',userLogin);

</script>



</body>
</html>