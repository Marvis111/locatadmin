<?php 
include '../controllers/server.php';
if (!isset($_SESSION['username']) && $_SESSION['userId']) {
    header('../controllers/login.php');
}
$productId = $_REQUEST['productId'];
if (!isset($productId)) {
  header('location:products.php');
}
if (isset($_POST['updateProduct'])) {
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
  $sql = "UPDATE products 
      set product_Name='$productName',product_Desc='$productDesc',
      product_price='$productPrice',available_qty='$productQty',productImg='$productImgNewName'

       where (product_Id = '$productId' and userId='$userId') ";
      
      $query = mysqli_query($conn,$sql);
      if ($query) {
        array_push($productSucessArray,'Product has been successfully Updated!');
      }
      


}
}





 ?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refrsh" content="3">
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
    <link rel="stylesheet" type="text/css" href="../assets/css/products.css">
	<link rel="stylesheet" type="text/css" href="../assets/jquery/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../assets/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/w3.css">
	<link href="../assets/css/style.css" rel="stylesheet">
	<!-- bootstrap -->
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/fonts/icomoon/style.css">


	<title>INQUISITIVE</title>
</head>
<body>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4;cursor: pointer;">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="icon-bars"></i> </button>
  <span class="w3-bar-item w3-right" style="margin-right: 20px;">LoCart</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../assets/images/iconfinder_3_avatar_2754579.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?php 
      if (isset($_SESSION['username'])) {
        echo $_SESSION['username'];
      }
         ?></strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="icon-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="icon-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="icon-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="index.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="icon-users fa-fw"></i>  Overview</a>
    <a href="notification.php" class="w3-bar-item w3-button w3-padding"><i class="icon-envelope fa-fw"></i>  Notification</a>
    <a href="products.php" class="w3-bar-item w3-button w3-padding"><i class="icon-product-hunt fa-fw"></i>  Products</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="icon-diamond fa-fw"></i>  Orders</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="icon-bell fa-fw"></i>  Offers</a>

    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="icon-user fa-fw"></i>  Profile</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="icon-cog fa-fw"></i>  Settings</a><br><br>
    <a href="../controllers/logout.php" class="w3-bar-item w3-button w3-padding"><i class="icon-power fa-fw"></i> Logout</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px;">
    <h5 style="font-size: 30px;"><b><i class="icon-dashboard"></i>Our Products</b></h5>
  </header>

<div class="mainSection">

  <button type="button" onclick="addProduct()" class="btn btn-primary justify-content-end addProduct" data-toggle="modal" data-target="myModal" >Products</button>
<div class="availableProducts ">
   <header class="w3-container" style="padding-top:22px;">
    <h5 style="font-size: 20px;font-family: serif;"><b>Add Products</b></h5>
  </header>
<hr>

<section class="orderSection " style="width: 100%; height: auto;text-align: center;margin-top: 30px;">

  <div class="productForm"></div>
<div class="productForm">

  <form method="POST" enctype="multipart/form-data" action="<?php echo "editProduct.php?productId=".$productId." " ?> ">
    <?php include '../controllers/errors.php' ?>
  <div class="form-group">
    <label for="name">Product's name</label>
    <input type="text" name="productName" class="form-control" 
    id="text" value="<?php get_product_details($conn,$productId,'product_Name') ?>">
  </div>
  <div class="form-group">
    <label for="">Product Price</label>
    <input type="number" name="productPrice" class="form-control" id="number" value="<?php get_product_details($conn,$productId,'product_price') ?>">
  </div>
  <div class="form-group">
    <label for="">Product description</label>
    <textarea name="productDesc" class="form-control" placeholder="<?php get_product_details($conn,$productId,'product_Desc') ?>" value="<?php get_product_details($conn,$productId,'product_Desc') ?>"></textarea>
  </div>
  <div class="form-group">
    <label for="">Available Quantity</label>
    <input type="number" name="productQty" class="form-control" id="number" value="<?php get_product_details($conn,$productId,'available_qty') ?>">
  </div>
  <div class="custom-file mb-3">
    <label for="Product Image">Product Image</label>
      <input type="file" name="productImg" class="custom" id="customFile" name="filename" value="<?php get_product_details($conn,$productId,'productImg') ?>">
    </div>
  <button type="submit" name="updateProduct"
   class="btn btn-primary">Update Product</button>
</form>



</div>
</section>






  
  <!-- End page content -->
</div>


<script>  
  $(document).ready(function(){
  
  });

  function addProduct(){
    location.assign('products.php');
  }
  $(document).on('click','.newProduct',function(){
     $('.orderSection').hide();
    $('.orderSection').eq(2).show(function(){
      $(this).fadeIn();
    });
  })





// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>

<!-- Mirrored from www.w3schools.com/w3css/tryit.asp?filename=tryw3css_templates_analytics&stacked=h by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 30 Jul 2018 00:45:20 GMT -->
</html>



</body>
</html>