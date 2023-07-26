<?php 
include "header.php"; 
if($_SESSION['user_role'] ==  "0"){
  header("location: ../../news-site/admin/post.php");
}
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1 class="admin-heading">All Categories</h1>
      </div>
      <div class="col-md-2">
        <a class="add-new" href="add-category.php">add category</a>
      </div>
      <div class="col-md-12">
       <?php 
       include "config.php";

       $limit = 10;
       if(isset($_GET['page'])){
        $page = $_GET['page'];
      }else{
        $page = 1;
      }

      $offset = ($page - 1)*$limit;

      if(isset($_GET['id']) && $_GET['id'] !=""){
        mysqli_query($con,"Delete from category where category_id = '".$_GET['id']."'");
        header("Location: category.php")    ;
      }

      $sql = mysqli_query($con, "SELECT * FROM category LIMIT $offset ,$limit");
      $sno = $offset+1;
      if(mysqli_num_rows($sql) > 0){
        ?>
        <table class="content-table">
          <thead>
            <th>S.No.</th>
            <th>Category Name</th>
            <th>No. of Posts</th>
            <th>Edit</th>
            <th>Delete</th>
          </thead>
          <?php 
          while($row = mysqli_fetch_assoc($sql)){
            ?>
            <tbody>
              <tr>
                <td class='id'><?php echo $sno; ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['post']; ?></td>
                <td class='edit'><a href='update-category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-edit'></i></a></td>
                <td class='delete'><a href='category.php?id=<?php echo $row['category_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
              </tr>
              <?php 
              $sno++;
            } ?>
          </tbody>
        </table>
      <?php } 

      $sql1 = mysqli_query($con, "SELECT * FROM category");

      if(mysqli_num_rows($sql1) > 0){
       $total_records = mysqli_num_rows($sql1);

       $total_page = ceil($total_records / $limit);

       echo '<ul class="pagination admin-pagination">';
       if($page > 1){
         echo '<li><a href="category.php?page='.($page - 1).'">Prev</a></li>';
       }

       for($i=1; $i<=$total_page; $i++){

        if($i == $page){
          $active = "active";
        }else{
          $active = "";
        }
        echo '<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
      }

      if($total_page > $page){
        echo '<li><a href="category.php?page='.($page + 1).'">Next</a></li>';
      }

      echo '</ul>';
    }
    ?> 
  </div>
</div>
</div>
</div>
<?php include "footer.php"; ?>
