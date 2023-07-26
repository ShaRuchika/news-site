<?php
include 'config.php';

$post_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql1 = mysqli_query($con, "SELECT * FROM post where post_id = '".$post_id."'");
$result = mysqli_fetch_assoc($sql1);

unlink("upload/".$result['post_img']);

$sql = "DELETE FROM post WHERE post_id = '".$post_id."';";
$sql .= "UPDATE category SET post = post -1 WHERE category_id = '".$cat_id."'";
$result = mysqli_multi_query($con, $sql);

if($result){
	header("location: ../../news-site/admin/post.php");
}else{
	echo "<div class='alert alert-danger'>Query failed</div>";
} 
?>