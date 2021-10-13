<?php

include 'server.php';
$productId = $_REQUEST['q'];

$sql = "DELETE FROM products where product_Id ='$productId' ";
$query = mysqli_query($conn,$sql);
if ($query) {
	echo " 
	 <div class='alert alert-success' style='width: 80% !important;margin: 2px auto !important'>
	 	<strong>Product Successfully Deleted!.</strong>
	 </div>

	 "	;
}