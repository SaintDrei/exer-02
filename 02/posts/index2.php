<?php
    include "../config.php";
    
    $sql_view = "SELECT p.postID, c.category, p.title, p.image, p.status, p.postDate FROM posts p INNER JOIN categories c ON p.catID = c.catID";
    $result_view = $con->query($sql_view) or die(mysqli_error($con));

?>

<!DOCTYPE html>
<html>
  <head>
    <title>View Post</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" type="text/css">
      
  </head>
    <body>
        <div class="container">
            <div class="col-lg-12">
            <h1 class="text-center"><i class="fa fa-list"></i>View Posts</h1>
                <form class="form-horizontal well">
                    <?php 
                            while ($row = mysqli_fetch_array($result_view)){
                                $id = $row['postID'];
                                $cat = $row['category'];
                                $title = $row['title'];
                                $img = $row['image'];
                                $stat = $row['status'];
                                $date = $row['postDate'];
                                echo "
                            <div class='media'>
                                 <div class='media-left'>
                                  <a href='details.php?id=$id'>
                                  <img class='media-object' width='100' src='$img' alt='$title'>
                                  </a>
                                </div>
                                <div class='media-body'>
                                 <h4 class='media-heading'>$title</h4>
                                 <em>Catgory: $cat</em><br>
                                 <small>$date</small>
                                </div>
                            </div>";
                            }
                                ?>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function(){
            $('#posts').DataTable();
        })
        </script>
    </body>
</html>