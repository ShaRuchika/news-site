<?php 
include "header.php";
include "config.php";

$stu_id = $_GET['id'];
$sql =mysqli_query($con,"SELECT * FROM user WHERE user_id = '".$stu_id."'");
$getData=mysqli_fetch_assoc($sql);

if(isset($_POST['submit']) && ($_POST['submit']) == 'Update'){
/*print_r($stu_id); die;*/
  $fname = $_POST['f_name'];
  $lname = $_POST['l_name'];
  $username = $_POST['username'];
  $role = $_POST['role'];

  $update = mysqli_query($con, "UPDATE user SET first_name='".$fname."',last_name='".$lname."',username='".$username."',role='".$role."' WHERE user_id='".$stu_id."'");
  header("location: users.php");
}
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading">Modify User Details</h1>
      </div>
      <div class="col-md-offset-4 col-md-4">
        <!-- Form Start -->
        <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$stu_id;?>" method ="POST">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="f_name" class="form-control" value="<?php echo $getData['first_name']; ?>" required />
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="l_name" class="form-control" value="<?php echo $getData['last_name']; ?>" required />
          </div>
          <div class="form-group">
            <label>User Name</label>
            <input type="text" name="username" class="form-control" value="<?php echo $getData['username']; ?>" required />
          </div>
          <div class="form-group">
            <label>User Role</label>
            <select class="form-control" name="role">
              <option value="0"<?php echo $getData['role'] == '0' ? 'selected' : ''; ?>>normal User</option>
              <option value="1"<?php echo $getData['role'] == '1' ? 'selected' : ''; ?>>Admin</option>
            </select>
          </div>
          <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
        </form>
        <!-- /Form -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
