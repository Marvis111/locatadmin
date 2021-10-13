<?php 
include 'server.php';
//get the request..
$searchedProduct = $_REQUEST['q'];
//
$sql = "SELECT * FROM products WHERE product_Name LIKE '%$searchedProduct%' ";
$query = mysqli_query($conn,$sql);
if ($query) {
	if (mysqli_num_rows($query) > 0) {
		while ($row = mysqli_fetch_assoc($query)) {
		if ($searchedProduct !=="") {
			if (strpos(strtolower($row['product_Name']),strtolower($searchedProduct)) !== -1 ) {
			echo "
 			 <div class='card' style='width: 300px'>
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
	}else{
		echo "<div class='alert alert-danger' style='width: 98%;margin: 4px auto'>
		<strong> No Product Found </strong>
		</div>";
	}
	
}