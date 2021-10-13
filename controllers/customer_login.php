<?php 
include 'server.php';
$customerEmail = $_POST['customerEmail'];
$customerPwd = $_POST['customerPwd'];

$error = "";
if (!filter_var($customerEmail,FILTER_VALIDATE_EMAIL)){
	$error = "Invalid Email Address ";
}else{
	$sql = "SELECT * FROM user_login where user_email = '$customerEmail'  ";
	$query = mysqli_query($conn,$sql);
	if ($query) {
		if (mysqli_num_rows($query) > 0) {
			$customer = mysqli_fetch_assoc($query);
		$user_pwd = $customer['user_password'];
		$aut_pwd = password_verify($customerPwd, $user_pwd);
		if ($aut_pwd == 1) {
			$_SESSION['username'] = $customer['user_name'];
			$_SESSION['userId'] = get_User_Id($GLOBALS['conn'],
				$_SESSION['username'],$customer['timeCreated']);
			
				
		}else{
			$error = " Wrong Email/Password combination";
		}
		}else{
			$error = " Wrong Email/Password combination";
		}

	}


}

if ($error !== "") {
	echo $error;
}