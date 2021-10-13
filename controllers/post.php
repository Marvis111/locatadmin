<?php 
include 'server.php';
//incoming request..
$q = $_REQUEST['q'];
//detach requests...
$postDetails = explode(',',$q);
//
$userPost = $postDetails[0];
$userId = $postDetails[1];
$username = $postDetails[2];
$postDate = date('M d h:ia');
$sql = "INSERT INTO posts(userId,userPost,postTime)
		VALUES('$userId','$userPost','$postDate')
		";
	mysqli_query($conn,$sql);

 