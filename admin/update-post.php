<?php 
include "header.php"; 

if($_SESSION['user_role'] == '0'){
  $post_id = $_GET['id'];
  $sql1 = mysqli_query($con, "SELECT author FROM post WHERE post_id = '".$post_id."'");

  $row2 = mysqli_fetch_assoc($sql1);
  if($row2['author'] != $_SESSION['user_id']){
    header("location: ../../news-site/admin/post.php");
  }
}
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <?php 
        include 'config.php';
        $post_id = $_GET['id'];
        $sql = mysqli_query($con, "SELECT post.post_id,post.title,post.description,category.category_name,post.post_img,post.category FROM post 
          LEFT JOIN category ON post.category = category.category_id
          LEFT JOIN user ON post.author = user.user_id
          WHERE post.post_id = '".$post_id."'");

        if(mysqli_num_rows($sql) > 0){
          while($row = mysqli_fetch_assoc($sql)){

            ?>
            <!-- Form for show edit-->
            <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
              <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id']; ?>" placeholder="">
              </div>
              <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title']; ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $row['description']; ?>
              </textarea>
            </div>
            <div class="form-group">
              <label for="exampleInputCategory">Category</label>
              <select class="form-control" name="category">
               <?php
               $sql1 = mysqli_query($con, "SELECT * FROM category");

               if(mysqli_num_rows($sql1) > 0){
                while($row1 = mysqli_fetch_assoc($sql1)){
                  if($row['category'] == $row1['category_id']){
                    $selected = "selected";
                  }else{
                    $selected = "";
                  }
                  echo "<option ".$selected." value=".$row1['category_id'].">".$row1['category_name']."</option>";
                }
              }
              ?>
            </select>
            <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>">
          </div>
          <div class="form-group">
            <label for="">Post image</label>
            <input type="file" name="new-image">
            <img src="upload/<?php echo $row['post_img']; ?>" height="150px" style="margin-top: 10px;">
            <input type="hidden" name="old-image" value="<?php echo $row['post_img']; ?>">
          </div>
          <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php 
      }
    }else{
      echo "user not found";
    }
    ?>
    <!-- Form End -->
  </div>
</div>
</div>
</div>
<?php include "footer.php"; ?>
