<?php 
//login errors
if (count($login_err_Array) > 0) {
	echo "<div class='alert alert-danger' style='width: 98%;margin: 4px auto'>";
	foreach ($login_err_Array as $error) {
		echo "<strong>".$error." </strong><br> ";
	}

	echo "</div>";
}

//adding products error...
if (count($productErr) > 0) {
	echo "<div class='alert alert-danger' style='width: 98%;margin: 1px auto'>";
	foreach ($productErr as $error) {
		echo "<strong>".$error." </strong><br> ";
	}

	echo "</div>";
}
//success... 
if (count($productSucessArray) > 0) {
	echo "<div class='alert alert-success' style='width: 98%;margin: 1px auto'>";
	foreach ($productSucessArray as $success) {
		echo "<strong>".$success." </strong><br> ";
	}
	echo "</div>";
}