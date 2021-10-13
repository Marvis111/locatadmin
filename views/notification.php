<?php 
include '../controllers/server.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['userId'])) {
    header('location:../registrations/login.php');
}
 ?>
 <!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refreh" content="3">
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
  <link rel="stylesheet" type="text/css" href="../assets/css/notification.css">
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
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="icon-users fa-fw"></i>  Overview</a>
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
    <h5 style="font-size: 30px;"><b><i class="icon-message"></i>Notifications</b></h5>
  </header>

<div class="mainSection">
<div class="availableProducts ">
   <header class="w3-container" style="padding-top:22px;">
    <h5 style="font-size: 20px;font-family: serif;"><b></b></h5>
  </header>
<hr>
 <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding">
              <h6 class="w3-opacity">Notify your Customers about new Products</h6>
          
                 <textarea class="form-control" id="userPost" placeholder="Type your Post"></textarea>
             <div class="custom-file" style="margin-top: 5px; width: 80%" >
    <input type="file" class="custom-file-input" id="customFile">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
              <button style="margin-top: 10px;" type="button" class="btn btn-primary " id="post" ><i class="icon-pencil"></i> Post</button>
              
            
    </div>
            </div>
          </div>
        </div>
      </div>
      <section class="post">
        
     

      </section>

   



<!-- The Modal -->
  

</div>

  
  <!-- End page content -->
</div>

<div class="user">
  <input type="hidden" name="userId" id="userId" value="<?php echo $_SESSION['userId'] ?>">
  <input type="hidden" name="username" id="username" value="<?php echo$_SESSION['username'] ?>">
</div>
<style type="text/css">
  .w3-card{

    min-width: 300px;
    }
</style>
<script>  
  $(document).ready(function(){
    $('.orderSection').hide();
   $('.orderSection').first().show();
   fetch_user_notifications();
   setInterval(()=>{
    fetch_user_notifications();
   },2000)

  });

function fetch_user_notifications(){
  $.ajax({
    url:'../controllers/fetch_user_notifications.php',
    method:'POST',
    success:function(data){
      $('.post').html(data);
    }
  })
}
$(document).on('click','#likeBtn',function(){
var postId = $(this).parent('.userPost').children('.messageId').val();
var post_user_Id = $(this).parent('.userPost').children('#userId').val();
var userId = $('#userId').val();


var likeDetails = [postId,post_user_Id,userId];
$.ajax({
  url:"../controllers/like.php?q="+likeDetails,
  method:"GET",
  success:function(){

  }

})
})

  $(document).on('click','#post',function(){
    var userPost = $('#userPost').val();
    var userId = $('#userId').val();
    var username = $('#username').val();
    if (userPost !=="") {
      postDetails = [userPost,userId,username];
      $.ajax({
        url:"../controllers/post.php?q="+postDetails,
        method:'POST',
        success:function(data){
          $('#userPost').val("");
        }
      })
    }
    
  })
















  function addProduct(){
    $('.orderSection').hide();
    $('.orderSection').eq(1).show(function(){
      $(this).fadeIn();
    });
  }
  $(document).on('click','.newProduct',function(){
   location.assign('addproducts.html');
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