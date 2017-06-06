<?php
    include "../config.php";
    $sql_cat = "SELECT catID, category FROM categories ORDER BY category";
    $result_cat = $con->query($sql_cat) or die(mysqli_error($con));
    $options = "";
    while ($row = mysqli_fetch_array($result_cat)){
        $catID = $row["catID"];
        $catName = $row["category"];
        $options = $options . "<option value='$catID'>$catName</option>";
    }

if (isset($_POST['save']))
{
    $cid = $_POST['category'];
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $keywords = mysqli_real_escape_string($con, $_POST['keywords']);
    $uploads = "../img/products";
    
    $image = $_FILES["image"]["name"];
    $newImage = date('YmdHis-') . basename($image);
    $file = $uploads. $newImage;
    move_uploaded_file($_FILES['image']['tmp_name'], $file);
    
//    $image = mysqli_real_escape_string($con, $_POST['image']);
    $status = $_POST['status'];
    //$status = mysqli_real_escape_string($con, $_POST['status']);
    
    $sql_insert = "INSERT INTO posts VALUES
    ('', $cid, '$title', '$content', '$keywords', '$image', '$status', NOW(), NOW())";
    
    $con-query($sql_insert) or die(mysqli_error($con));
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Add a Post</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../css/jasny-bootstrap.min.css" rel="stylesheet">
      
  </head>
  <body>
    <div class="container">
      <div class="col-lg-offset-3 col-lg-6">
        <h1 class="text-center"><i class="fa fa-pencil"></i> Add a Post</h1>  
        <form method="POST" class="form-horizontal well" enctype="multipart/form-data">
        		<div class="form-group">
					<label class="control-label col-lg-4">Category</label>
					<div class="col-lg-8">
                        <select name="category" class="form-control" required>
                            <option value="">Select one...</option>
                            <?php echo $options; ?>
                        </select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4">Title</label>
					<div class="col-lg-8">
						<input name="title" type="text" class="form-control" required />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4">Content</label>
					<div class="col-lg-8">
						<textarea name="content" id="content" type="text" class="form-control" required></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4">Keywords</label>
					<div class="col-lg-8">
						<input name="keywords" type="text" class="form-control" required />
					</div>
				</div>
                <div class="form-group">
                    <label class="control-label col-lg-4">Image</label>
                    <div class="col-lg-8">
                       <div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
  <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
</div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-lg-4">Status</label>
                    <div class="col-lg-8">
                        <select name="status" class="form-control" required>
                            <option value="Draft">Draft</option>
                            <option value="Published">Published</option>
                        </select>
                    </div>
                </div>
				<div class="form-group">
					<div class="col-lg-offset-4 col-lg-8">
						<button name="save" type="submit" class="btn btn-success">
							Save
						</button>
					</div>
				</div>
		</form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../libraries/ckeditor/ckeditor.js"></script>
    <script>
    CKEDITOR.replace('content');
    </script>
    <script src="../js/jasny-bootstrap.min.js"> </script>  
  </body>
</html>