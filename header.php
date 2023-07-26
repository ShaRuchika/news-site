<?php
include 'config.php';
$page = basename($_SERVER['PHP_SELF']);
$page_title = '';
switch($page){
    case "single.php":
    if(isset($_GET['id'])){
        $sql_title = mysqli_query($con, "SELECT * FROM post WHERE post_id = '".$_GET['id']."'");
        $row_title = mysqli_fetch_assoc($sql_title);
        $page_title = $row_title['title'];
    }else{
        $page_title = "No record found";
    }
    break;
    case "category.php":
    if(isset($_GET['cid'])){
        $sql_title = mysqli_query($con, "SELECT * FROM category WHERE category_id = '".$_GET['cid']."'");
        $row_title = mysqli_fetch_assoc($sql_title);
        $page_title = $row_title['category_name'] . " News";
    }else{
        $page_title = "No category found";
    }
    break;
    case "author.php":
    if(isset($_GET['aid'])){
        $sql_title = mysqli_query($con, "SELECT * FROM post JOIN user
            ON post.author = user.user_id
            WHERE post.author = '".$_GET['aid']."'");
        $row_title = mysqli_fetch_assoc($sql_title);
        $page_title = "News By " . $row_title['first_name'] . " " . $row_title['last_name'];
    }else{
        $page_title = "No Post found";
    }
    break;
    case "search.php":
    if(isset($_GET['search'])){
        $page_title = $_GET['search'];
    }else{
        $page_title = "No Search result found";
    }
    break;
    default:
    $page_title =  "News-site";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-2">
                    <?php
                    include "config.php";

                    $sql = mysqli_query($con,"SELECT * FROM settings");

                    if(mysqli_num_rows($sql) > 0){
                        while($row = mysqli_fetch_assoc($sql)) {
                            if($row['logo'] == ""){
                                echo '<a href="index.php">'.$row['websitename'].'</a>';
                            }else{
                                echo '<a href="index.php" id="logo"><img src="admin/images/'. $row['logo'].'"></a>';
                            }
                        }
                    }
                    ?>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    include 'config.php';

                    if(isset($_GET['cid'])){
                        $cat_id = $_GET['cid'];
                    }

                    $sql = mysqli_query($con, "SELECT * FROM category WHERE post > 0");
                    $active='';

                    if(mysqli_num_rows($sql) > 0){
                        ?>
                        <ul class='menu'>
                            <li><a href='index.php'>Home</a></li>
                            <?php while($row = mysqli_fetch_assoc($sql)){

                                if(isset($_GET['cid'])){
                                   if($row['category_id'] == $cat_id){
                                    $active = 'active';
                                }else{
                                    $active = '';
                                }
                            }

                            echo "<li><a class='".$active."' href='category.php?cid=".$row['category_id']."'>".$row['category_name']."</a></li>";
                        } ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
