<?php
include 'config.php';

if(empty($_FILES['logo']['name'])){
	$file_name = $_POST['old-logo'];
}else{
	$error = array();

	$file_name = $_FILES['logo']['name'];
	$file_size = $_FILES['logo']['size'];
	$file_temp = $_FILES['logo']['tmp_name'];
	$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
	$extensions = array("jpeg","jpg","png");

	if(in_array($file_extension, $extensions) === false){
		$error[] = "This extension is not allowed. Please choose a jpg , jpeg or png";
	}
	if($file_size > 2097152){
		$error[] = "File size must be 2mb or lower";
	}
	if(empty($error) == true){
		move_uploaded_file($file_temp,"images/".$file_name);
	}else{
		print_r($error);
		die;
	}
}

$name = $_POST['website_name'];
$footerdesc = $_POST['footer_desc'];

$sql = mysqli_query($con, "UPDATE settings SET websitename='".$name."', logo='".$file_name."', footerdesc='".$footerdesc."'");
if($sql){
	header("location: ../../news-site/admin/post.php");
}else{
	echo "<div class='alert alert-danger'>Query failed</div>";
} 

?>