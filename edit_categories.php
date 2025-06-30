<?php

session_start();
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";


$conn = new mysqli($hostname, $username, $password, $dbname);

function getAll($table) {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM $table");
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(!isset($_GET['id'])){
    $_SESSION['message'] = "Invalid Category ID";
    header("Location: added_categories.php");
    exit();
}

$category_id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE id = '$category_id'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) !== 1 ){
    $_SESSION['message'] = "Category not found";
    header("location: added_categories.php");
    exit();
}
$category = mysqli_fetch_assoc($result);

// handle update submission
if(isset($_POST['update_category'])){
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $popular = isset($_POST['popular']) ? '1' : '0';
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1' : '0';
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];



    // Handle image upload
    $image = $_FILES['image']['name'];
    if(!empty($image)){
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;
        $upload_path = "catuploads/" . $filename;
       move_uploaded_file($image_tmp, $upload_path);
    }else{
        $filename = $_POST['image']; // Keep the old image if no new image is uploaded
    }
    $update_query = "UPDATE categories SET
        -- category_id = '$category_id',
        name = '$name',
        slug = '$slug',
        description = '$description',
        image = '$filename',
        status = '$status',
        popular = '$popular',
        meta_title = '$meta_title',
        meta_keywords = '$meta_keywords',
        meta_description = '$meta_description'
        WHERE id = '$category_id'";



    if(mysqli_query($conn, $update_query)){
    $_SESSION['message'] = "Category Updated Successfully";
    header("Location: added_categories.php");
    exit();
} else {
    $_SESSION['message'] = "Update failed: " . mysqli_error($conn);
}

    // Redirect to the categories page with a success message
    // $_SESSION['message'] = "Category Updated Successfully";
    // header("Location: added_categories.php");
    // exit();
    
    }
    ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <title>ClassicCave</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Miniver&family=Poppins&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <button class="back">
        <a href="admin_dashboard.php" style="text-decoration: none; color: black;">Back</a>
    </button>
</div>



 <div class="container mt-5 pt-5">
        <h1 class="mt-5 pt-5">Edit Category</h1>
         <div class="card-body">
                    <!-- Form to submit category details -->
                    <!-- 'multipart/form-data' allows file uploads -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="row">

                         
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" value="<?= $category['name']?>"  class="form-control">
                            </div>

                         
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" value="<?= $category['slug']?>" class="form-control">
                            </div>

                          
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea rows="3" name="description"  class="form-control"><?= $category['description']?></textarea>
                            </div>
                            <div class="mb-3">
                                <label>Current Image</label><br>
                                <img src="catuploads/<?= $category['image']; ?>" width="120" class="img-thumbnail">
                            </div>

                          
                            <div class="col-md-12">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                          
                            <div class="col-md-12">
                                <label for="">Meta title</label>
                                <textarea rows="3" name="meta_title" class="form-control"><?= $category['meta_title'] ?></textarea>

                            </div>

                            
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea rows="3" name="meta_description" class="form-control"><?= $category['meta_description']?></textarea>
                            </div>

                          
                            <div class="col-md-12">
                                <label for="">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" class="form-control"><?= $category['meta_keywords']?></textarea>
                            </div>

                            
                            <div class="col-md-6">
                                <label for="">Status</label><br>
                                <input type="checkbox" name="status" <?= $category['status'] ? 'checked' : ''; ?>>
                            </div>

                            
                            <div class="col-md-6">
                                <label for="">Popular</label><br>
                                <input type="checkbox" name="popular" <?= $category['popular'] ? 'checked' : ''; ?>>
                            </div>

                          
                            <div class="col-md-12">
                                <input type="hidden" name="image" value="<?= $category['image']; ?>">
                                <button type="submit" name="update_category" class="btn btn-primary">Update Category</button>
                            </div>

                        </div> 
                    </form>
                </div>
    </div>


     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>