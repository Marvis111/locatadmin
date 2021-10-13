<?php
include 'functions.php';
session_start();
date_default_timezone_set('Africa/Lagos');
 $dbServername ='localhost';
$dbUsername="root";
$dbPassword="";
$locat_database = 'locatdb';
 $conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$locat_database);
// handle 404 error
$request = $_SERVER['REQUEST_URI'];
// get the dirname and base name
$dir_name = dirname($request);
//
$file_name = basename($request);
//
 //

$login_err_Array = array();
class locatCustomers{
	private $username, $userEmail,$user_pwd,$user_comf_pwd;

	public function validate_user_name($username){
		if (!empty($username)) {
			$username = trim($username);
			$username = htmlspecialchars($username);
			$username = stripslashes($username);

			return true;
		}else{
			array_push($GLOBALS['login_err_Array'], 'Username is required.');
		}
	}
	public function validate_user_email($userEmail){
		
		if (!empty($userEmail)) {
			if (!filter_var($userEmail,FILTER_VALIDATE_EMAIL)) {
			array_push($GLOBALS['login_err_Array'], 'Invalid Email address');
			return false;
	
		}else{
			return true;
		}	
		}else{
			array_push($GLOBALS['login_err_Array'], 'Email address is required');
			return false;
		}
	}
	private function validate_user_pwd($user_pwd,$user_comf_pwd){
		if (!empty($user_comf_pwd) && !empty($user_pwd)) {
			if ($user_pwd == $user_comf_pwd) {
				return true;
			}else{
				array_push($GLOBALS['login_err_Array'], 'Password Mismatched.');
				return false;
			}
		}else{
			array_push($GLOBALS['login_err_Array'], 'Password is required.');
			return false;
		}
	}
	
	function __construct($Username,$userEmail,$user_pwd,$user_comf_pwd){
		if ($this->validate_user_name($Username) && 
			$this->validate_user_email($userEmail) && 
			$this->validate_user_pwd($user_pwd,$user_comf_pwd)
		    ) {
			$user_pwd = password_hash($user_pwd, PASSWORD_DEFAULT);
			$timeCreated = time();
	 		$GLOBALS['sql'] = "INSERT INTO user_login(user_name,user_email,user_password,timeCreated)
	 			values('$Username','$userEmail','$user_pwd','$timeCreated') ";
	 			$GLOBALS['sqlQuery'] = mysqli_query($GLOBALS['conn'],$GLOBALS['sql']);

	 			$_SESSION['username'] = $Username;
	 			$_SESSION['userId'] = get_User_Id($GLOBALS['conn'],$_SESSION['username'],$timeCreated);
	 			header('location:../customers/index.php');

		}


	}

}

class adminLogin{
	private $adminId ,$adminPassword;

	public function validate_admin_Id($adminId){
		if (!empty($adminId)) {
			return true;
		}else{
			array_push($GLOBALS['login_err_Array'], 'Admin Id is required');
			return false;
		}
	}
	public function validate_admin_Pwd($adminPassword){
		if (!empty($adminPassword)) {
			return true;
		}else{
			array_push($GLOBALS['login_err_Array'],'Password is required');
			return false;
		}
	}

	function __construct($adminId,$adminPassword){
		if ($this->validate_admin_Id($adminId) &&
			$this->validate_admin_Pwd($adminPassword)
	) {
		$sql = "SELECT * FROM user_login where id = '$adminId' ";
		$sqlQuery = mysqli_query($GLOBALS['conn'],$sql);
		if ($sqlQuery) {
			if (mysqli_num_rows($sqlQuery) > 0) {
				$user = mysqli_fetch_assoc($sqlQuery);
			$user_pwd = $user['user_password'];
			$auth_pwd = password_verify($adminPassword, $user_pwd);
			if ($auth_pwd == 1) {
				$_SESSION['username'] = $user['user_name'];
			$_SESSION['userId'] = get_User_Id($GLOBALS['conn'],$_SESSION['username'],$adminId);
				header('location:../views/index.php');
			}else{
				array_push($GLOBALS['login_err_Array'], 'Wrong Admin Id / Password combination.');
				return false;
			}

			}else{
				array_push($GLOBALS['login_err_Array'], 'Wrong Admin Id / Password combination.');
				return false;
			}
		}
	  }
	}

}

//1608217889

//login clicks..
if (isset($_POST['admin_Login'])) {
	new adminLogin($_POST['adminId'], $_POST['adminPassword']);
}
if (isset($_POST['customer_signup'])) {
	new locatCustomers($_POST['customer_name'],
		 $_POST['customer_email'], $_POST['customer_password'],
		  $_POST['comf_password']);
}

 
 $productErr  = array();

$productSucessArray = array();
//adding products..
if (isset($_POST['registerProduct'])) {
	$productName = mysqli_real_escape_string($conn,$_POST['productName']);
	$productPrice = mysqli_real_escape_string($conn,$_POST['productPrice']);
	$productDesc = mysqli_real_escape_string($conn,$_POST['productDesc']);
	$productQty = mysqli_real_escape_string($conn,$_POST['productQty']);
	

	//validat non files
	
	if (empty($productName)) {
		array_push($productErr, 'Product Name is required');
	}
	if (empty($productPrice)) {
		array_push($productErr, 'Product price is required');
	}
	if (empty($productDesc)) {
		array_push($productErr,' Product descriptions help illustrates your product');
	}
	if (empty($productQty)) {
		array_push($productErr, 'You need to let your customers know the quantities available');
	};

//image...
$productImgNewName = '';
$productImgDestination ="../assets/productImages";
	$productImg = $_FILES['productImg'];
	$productImgName = $productImg['name'];
	$productImgTmpName = $productImg['tmp_name'];
	$productImgSize = $productImg['size'];
	$productImgError = $productImg['error'];
	//
	$alowedFileExt = array('img','jpg','jpeg','png');
	//
	$imgDetach = explode('.', $productImgName);
	//img Extension..
	$imgExt = end($imgDetach);
	//validation..
	if (in_array($imgExt, $alowedFileExt)) {
		if ($productImgError == 0) {
			if ($productImgSize < 1000000) {
				$productImgNewName = time().".".$imgExt;

			}else{
				array_push($productErr,'The selected Image is too large');
			}
		}else{
			array_push($productErr, 'Error selecting Product Image');
		}
	}else{
		array_push($productErr,'This is not a valid Product Image');
	}
	
if (count($productErr) == 0) {
	$userId = $_SESSION['userId'];
	$time_created = time();
	move_uploaded_file($productImgTmpName,$productImgDestination."/".$productImgNewName);
	$sql = "INSERT INTO 
	products(userId,product_Name,product_Desc,product_price,available_qty,productImg,time_created )
			VALUES('$userId','$productName','$productDesc','$productPrice','$productQty','$productImgNewName','$time_created') ";
			mysqli_query($conn,$sql);

			array_push($productSucessArray,'Product has been successfully Added!');


}
}
//updating product..

/*
function insertAdminDetails($conn){
	$time_created = time();
$sql = 'INSERT INTO user_login (id,user_name,user_email,user_password,timeCreated )
values(189,'Oyegbile Marvellous','marvelloustony1@gmail.com','445544','$timeCreated')';
$query = mysqli_query($conn,$sql);
}
insertAdminDetails($conn);

*/
//echo (password_hash('445544',PASSWORD_DEFAULT));