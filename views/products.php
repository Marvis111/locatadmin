<?php 
include '../controllers/server.php';
if (!isset($_SESSION['username']) && $_SESSION['userId']) {
    header('../controllers/login.php');
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refres" content="3">
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
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="icon-envelope fa-fw"></i>  Notification</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="icon-product-hunt fa-fw"></i>  Products</a>
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
<div class="first-head">
  <div class="input-group mb-3" >
  <input type="text" id="search" style="height: 40px;margin-left: 5px !important;" class="form-control" placeholder="Search">
</div>
 <button type="button" onclick="addProduct()" class="btn btn-primary justify-content-end addProduct " style="padding: 5px;height: 40px; " data-toggle="modal" data-target="myModal" >
  Add Products</button>
  

</div>
 
<div class="availableProducts ">
   <header class="w3-container" style="padding-top:22px;">
    <h5 style="font-size: 20px;font-family: serif;"><b>Available Products</b></h5>
  </header>
<hr>
<div class="delSuccess">
  
</div>


 <section class="orderSection" style="width: 100%; height: auto;text-align: center;margin-top: 30px;">

  <div class="productsArena">
    <?php
    fetch_available_Products($conn);
   ?>
  </div>
   
</section>
<section class="orderSection " style="width: 100%; height: auto;text-align: center;margin-top: 30px;">
  <div class='card addproducts newProduct' style="width: 300px;height: 380px;">
        <div class="cardHeader">
          <i class="icon-product-hunt text-info"></i>
        </div>
        <div class="cardDesc">
          <h3>Add New Products</h3>
      <p>
       Let the world know about the new products in your store, the price, quantity available and the discount per product.
        
      </p>
        </div>
  </div>
  <div class='card addproducts newService' style="width: 300px;height: 380px;">
        <div class="cardHeader">
          <i class="icon-product-hunt text-info"></i>
        </div>
        <div class="cardDesc">
          <h3>Add New Services</h3>
      <p>
       Let the world know about the new services in your organisation , the price,  and the discount per services.
        
      </p>
        </div>
  </div>
</section>
<section class="orderSection " style="width: 100%; height: auto;text-align: center;margin-top: 30px;">

  <div class="productForm"></div>
<div class="productForm">

  <form action="/action_page.php">
  <div class="form-group">
    <label for="name">Product's name</label>
    <input type="text" class="form-control" id="text">
  </div>
  <div class="form-group">
    <label for="">Product Price</label>
    <input type="number" class="form-control" id="number">
  </div>
  <div class="form-group">
    <label for="">Product description</label>
    <textarea class="form-control"></textarea>
  </div>
  <div class="custom-file mb-3">
    <label for="Product Image">Product Image</label>
      <input type="file" class="custom-file-input" id="customFile" name="filename">
      <label class="custom-file-label" for="customFile">Product Image</label>
    </div>

  <button type="submit" class="btn btn-primary">Register product</button>
</form>



</div>



        
</section>






<!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog ">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->

        <div class="modal-body">
        </div>
        <!-- Modal footer -->`
        <div class="modal-footer">
          <input type="hidden" class="prod_Id" value="" name="">
          <button type="button" data-dismiss="modal" class="btn btn-danger deleteProduct" >Delete</button>
        </div>
        
      </div>
    </div>
  </div>
</div>

</div>

  
  <!-- End page content -->
</div>

<style type="text/css">
  .delProduct{
    position: absolute;
    color:  #003366;
    font-size: 20px;
    cursor: pointer;
  }
  .card{
    
  }
  .first-head{
    width: 100%;
    display: flex;
    height: 60px;
    justify-content: space-between;
  }
  .mb-3{
    width: 40%;
  }
</style>
<script>  
  $(document).ready(function(){
    $('.orderSection').hide();
   $('.orderSection').first().show();

  });

  $(document).on('keyup','#search',function(){
    var searchWord = $(this).val();
      if (searchWord !=="") {
         $.ajax({
      url:'../controllers/productSearch.php?q='+searchWord,
      method:'GET',
      success:function(data){
        $('.productsArena').html(data);

      }
    })
       }else{
        return false;
       }
  })

$(document).on('click','.deleteProduct',function(){
  var ProductId = $(this).parent('.modal-footer').children('input').val();
  $.ajax({
    url:"../controllers/deleteProduct.php?q="+ProductId,
    method:"GET",
    success:function(data){
      $('.delSuccess').html(data);
      setTimeout(()=>{
        location.reload();
      },2000);
    }
  })
})




  function addProduct(){
    $('.orderSection').hide();
    $('.orderSection').eq(1).show(function(){
      $(this).fadeIn();
    });
  }
  $(document).on('click','.newProduct',function(){
   location.assign('addproducts.php');
  })

$(document).on('click','.delProduct',function(){
 var productId = $(this).parent('.card').children('input').val();
 var productName = $(this).parent('.card').children('.card-body').children('h4').html();
 $('.modal-title').html(productName);
 $('.modal-body').html('<h5>Are you sure you want to delete this Product?</h4>');
 $('.prod_Id').val(productId);

  
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