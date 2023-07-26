<?php
include 'config.php';
session_start();

if(isset($_FILES['fileToUpload'])){
	$error = array();

	$file_name = $_FILES['fileToUpload']['name'];
	$file_size = $_FILES['fileToUpload']['size'];
	$file_temp = $_FILES['fileToUpload']['tmp_name'];
	$file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
	$extensions = array("jpeg","jpg","png");

	if(in_array($file_extension, $extensions) === false){
		$error[] = "This extension is not allowed. Please choose a jpg , jpeg or png";
	}
	if($file_size > 2097152){
		$error[] = "File size must be 2mb or lower";
	}
	if(empty($error) == true){
		move_uploaded_file($file_temp,"upload/".$file_name);
	}else{
		print_r($error);
		die;
	}
}



$title = $_POST['post_title'];
$description = $_POST['postdesc'];
$category = $_POST['category'];
$date = date("d M, Y");
$author = $_SESSION['user_id'];

$des = str_replace("'","\'", $description);   
$sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('".$title."','".$des."','".$category."','".$date."','".$author."','".$file_name."');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = '".$category."'";
$result = mysqli_multi_query($con, $sql);

if($result){
	header("location: ../../news-site/admin/post.php");
}else{
	echo "<div class='alert alert-danger'>Query failed</div>";
} 

?>