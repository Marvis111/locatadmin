<?php 
include 'server.php';
//get the request..
$q = $_REQUEST['q'];
//detach..
$likeDetails = explode(',', $q);
//
$postId = $likeDetails[0];
$post_user_Id = $likeDetails[1];
$userId = $likeDetails[2];

$sql = "SELECT * FROM post_likes where  postId ='$postId' and userId='$userId' ";
$query = mysqli_query($conn,$sql);
if ($query) {
	$rowNo = mysqli_num_rows($query);
	if ($rowNo > 0) {
		
	}else{
		$sql = "INSERT INTO post_likes (postId,userId,post_user_Id)
		VALUES('$postId','$userId','$post_user_Id')";
		mysqli_query($conn,$sql);
	}
}