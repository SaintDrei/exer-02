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
                    <table id="posts" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Post Date</th>
                                <th>Actions</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php 
                            while ($row = mysqli_fetch_array($result_view)){
                                $id = $row['postID'];
                                $cat = $row['category'];
                                $title = $row['title'];
                                $img = $row['image'];
                                $stat = $row['status'];
                                $date = $row['postDate'];
                                
                                echo "<tr>
                                <td>" . $id . "</td>                                 
                                <td>" . $cat . "</td>
                                <td>" . $title . "</td>
                                <td><img src='" . $img . "' width='150px' height='180px'></td>
                                <td>" . $stat . "</td>
                                <td>" . $date . "</td>
                                <td>
                                <a href='details.php?id=$id' class='btn btn-xs btn-info'> <i class='fa fa-edit'></i> 
                                </a>
                                <a href='delete.php?id=$id' class='btn btn-xs btn-danger'>
                                <i class='fa fa-trash-o'></i>
                                </a>
                                </td>
                                </tr>
                                ";
                            }
                            
                                
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Post Date</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
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