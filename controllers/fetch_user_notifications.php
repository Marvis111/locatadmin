<?php 
include 'server.php';

fetch_user_notifications($conn,$_SESSION['userId'],$_SESSION['username']);