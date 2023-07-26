<?php 
include "header.php"; 
include "config.php"; 

$stu_id = $_GET['id'];
$sql =mysqli_query($con,"SELECT * FROM category WHERE category_id = '".$stu_id."'");
$getData=mysqli_fetch_assoc($sql);
 
if(isset($_POST['sumbit']) && ($_POST['sumbit']) == 'Update'){


  $category_name = $_POST['cat_name'];

  $update = mysqli_query($con, "UPDATE category SET category_name='".$category_name."' WHERE category_id='".$stu_id."'");
  header("location: category.php");
}
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="adin-heading"> Update Category</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$stu_id;?>" method ="POST">
          <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="cat_name" class="form-control" value="<?php echo $getData['category_name']; ?>" required/>
          </div>
          <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
        </form>
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
