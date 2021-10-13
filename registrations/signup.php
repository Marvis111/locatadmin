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
<a class="navbar-brand" href="#">
    <img src="../assets/images/bird.jpg" alt="Logo" style="width:40px;">
    <span>INQUISITIVE</span>
  </a>


  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="icon-person"> login</i></a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="#"><i class="icon-group"> Signup</i></a>
      </li> 
    </ul>
  </div> 
</nav>
<section class="section-hero">
	<div class="formDiv">
		<div class="form_login">
			<h3><b>Login</b></h3>
		</div>
		<div class="form">
			<form  method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> ">
				<?php 
					include '../controllers/errors.php';
				?>
  <label for="email">Name:</label>
  <input type="text" class="form-control" name="customer_name" id="name">
  <label for="email">Email address:</label>
  <input type="text" class="form-control" name="customer_email" id="email">
  <label for="pwd">Password:</label>
  <input type="password" class="form-control" name="customer_password"  id="pwd">
   <label for="Cpwd"> Confirm Password:</label>
  <input type="password" class="form-control" name="comf_password"  id="Cpwd">

  <button type="submit" name="customer_signup" class="btn btn-primary formSubmit" style="margin-left: 5px;">Sign Up</button>

  
</form>

		</div>
		<div class="register">
			<p>Dont have an account? <a href="signup.php">Register</a></p>
		</div>


	</div>

</section>




</body>
</html>