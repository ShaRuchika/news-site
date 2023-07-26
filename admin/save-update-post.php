<?php
include 'config.php';

if(empty($_FILES['new-image']['name'])){
	$file_name = $_POST['old-image'];
}else{
	$error = array();

	$file_name = $_FILES['new-image']['name'];
	$file_size = $_FILES['new-image']['size'];
	$file_temp = $_FILES['new-image']['tmp_name'];
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
$post_id = $_POST['post_id'];
$title = $_POST['post_title'];
$description = $_POST['postdesc'];
$category = $_POST['category'];

$des = str_replace("'","\'", $description);  

$sql = "UPDATE post SET title='".$title."', description='".$des."', category='".$category."', post_img='".$file_name."' WHERE post_id='".$post_id."';";
if($_POST['old_category'] != $_POST['category']){
	$sql .= "UPDATE category SET post = post - 1 WHERE category_id = '".$_POST['old_category']."';";
	$sql .= "UPDATE category SET post = post + 1 WHERE category_id = '".$_POST['category']."';";
}

$result = mysqli_multi_query($con,$sql);

if($result){
	header("location: ../../news-site/admin/post.php");
}else{
	echo "<div class='alert alert-danger'>Query failed</div>";
} 

?>