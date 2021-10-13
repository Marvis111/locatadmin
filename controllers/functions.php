<?php
//functions here are required..

//functions that returns user id ...
function get_User_Id($conn,$username,$timeCreated){
	$sql = "SELECT * FROM user_login 
	where user_name = '$username' 
	and timeCreated = '$timeCreated' ";
	$query = mysqli_query($conn,$sql);
	if ($query) {
		while ($user = mysqli_fetch_assoc($query)) {
			return $user['id'];
		}
	}
};

 function checkInput($input,$productErr){
 	if (empty($input)) {
 		array_push($productErr, $input." is required");
 	}
 }
 //get all products.. for admin...
 function fetch_available_Products($conn){
 	$sql = "SELECT * FROM products ";
 	$query = mysqli_query($conn,$sql);
 	if ($query) {
 		while ($row = mysqli_fetch_assoc($query)) {
 			echo "
 			 <div class='card' style='width: 300px'>
 			 <input type='hidden' class='productId' value='".$row['product_Id']."'>
 			 <div class='delProduct' data-toggle='modal' data-target='#myModal'>
    <i class='icon-delete'></i>
  </div>  
          <img class='card-img-top' src='../assets/productImages/".$row['productImg']."' alt='Card image' style='width:100%'>
          <div >
            <a href='editProduct.php?productId=".$row['product_Id']." '> <span class='icon-cog cogStyle'></span> </a>
          </div>
           <div class='card-body'>
            <h4 class='card-title'>".$row['product_Name']."</h4>
            <p class='card-text' style='font-size:90%;font-weight:400;'>".$row['product_Desc']."</p>
            <div class='flex' style='display:flex;width:100%;justify-content:space-between;height: 38px; align-items: center;'>
            <button class='btn transform'  style='background-color: #0a2a66;color:white;'>Order</button>
            <span class='text-muted'>".$row['product_price']."</span>
            </div>
            <div class='card-footer'>
              <span class='text-success'>Available Quantity:</span>
              <b class='Quantity text-info'>
                ".$row['available_qty']."
              </b>
            </div>
         </div>
        </div>
 			";
 		}
 	}
 }
 //for customers..
 
function get_product_details($conn,$productId,$productData){
	$data = '';
	$sql = "SELECT * FROM products where product_Id = '$productId' ";
	$query = mysqli_query($conn,$sql);
	if ($query) {
		while ($row = mysqli_fetch_assoc($query)) {
			echo  $row[$productData];
		}
	}
}

function fetch_user_notifications($conn,$userId,$username){
  $sql = "SELECT * FROM posts where userId ='$userId' ORDER BY Id DESC ";
  $query = mysqli_query($conn,$sql);
  if($query){
    while ($row = mysqli_fetch_assoc($query)) {
      echo "

      <div class='w3-container w3-card w3-white w3-round w3-margin userPost'><br>
      <input type='hidden' id='userId' value='".$userId."' >
        <img src='../assets/images/iconfinder_3_avatar_2754579.png' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
        <span class='w3-right w3-opacity'>".$row['postTime']."</span>
        <h4>".$username."</h4><br>
        <hr class='w3-clear'>
        <p>".$row['userPost']."</p>
        <input type='hidden' class='messageId' id='messageId' value='".$row['Id']."' >

        <button type='button' id='likeBtn' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='icon-thumbs-up'>
        ".fetch_post_likes($conn,$row['Id'])."
        </i>  Like</button> 
        <button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='icon-comment'></i>  Comment</button> 
      </div>





      ";
    }
  }
}
function fetch_available_ProductsForCustomers($conn){
    $sql = "SELECT * FROM products ";
  $query = mysqli_query($conn,$sql);
  if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
      echo "
       <div class='card' style='width: 300px'>
       <input type='hidden' class='productId' value='".$row['product_Id']."'>
          <img class='card-img-top' src='../assets/productImages/".$row['productImg']."' alt='Card image' style='width:100%'>
           <div class='card-body'>
            <h4 class='card-title'>".$row['product_Name']."</h4>
            <p class='card-text' style='font-size:90%;font-weight:400;'>".$row['product_Desc']."</p>
            <div class='flex' style='display:flex;width:100%;justify-content:space-between;height: 38px; align-items: center;'>
            <button class='btn transform'  style='background-color: #0a2a66;color:white;'>Order</button>
            <span class='text-muted'>$".$row['product_price']."</span>
            </div>
            <div class='card-footer'>
              <span class='text-success'>Available Quantity:</span>
              <b class='Quantity text-info'>
                ".$row['available_qty']."
              </b>
            </div>
         </div>
        </div>
      ";
    }
  }
}

function fetch_post_likes($conn,$postId){
  $sql = "SELECT * FROM post_likes where postId = '$postId' ";
  $query = mysqli_query($conn,$sql);
  if ($query) {
    $rowNo = mysqli_num_rows($query);
    return $rowNo;
  }
}
function get_Admin_name($conn,$adminId){
  $sql = "SELECT * FROM user_login where Id = '$adminId' ";
  $query = mysqli_query($conn,$sql);
  if ($query) {
    while ($row = mysqli_fetch_assoc($query)) {
      return $row['user_name'];
    }
  }
}

function fetch_Admins_notifications($conn){
  $sql = "SELECT * from posts order by Id DESC ";
  $query = mysqli_query($conn,$sql);
  if ($query) {
      while ($row = mysqli_fetch_assoc($query)) {
        echo "
         <div class='w3-container w3-card w3-white w3-round w3-margin userPost'><br>
      <input type='hidden' id='userId' value='".$row['Id']."' >
        <img src='../assets/images/iconfinder_3_avatar_2754579.png' alt='Avatar' class='w3-left w3-circle w3-margin-right' style='width:60px'>
        <span class='w3-right w3-opacity'>".$row['postTime']."</span>
        <h4>".get_Admin_name($conn,$row['userId'])."</h4><br>
        <hr class='w3-clear'>
        <p>".$row['userPost']."</p>
        <input type='hidden' class='messageId' id='messageId' value='".$row['Id']."' >

        <button type='button' id='likeBtn' class='w3-button w3-theme-d1 w3-margin-bottom'><i class='icon-thumbs-up'>
        ".fetch_post_likes($conn,$row['Id'])."
        </i>  Like</button> 
        <button type='button' class='w3-button w3-theme-d2 w3-margin-bottom'><i class='icon-comment'></i>  Comment</button> 
      </div>






        ";
      }
  }
}