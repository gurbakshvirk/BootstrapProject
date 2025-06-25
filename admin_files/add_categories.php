
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "CCBS";


$conn = new mysqli($hostname, $username, $password, $dbname);


if (isset($_POST['add_category_btn'])) {
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = "./uploads" . $image;
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    // $cate_query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image)
    //                VALUES ('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";
    // $cate_query_run = mysqli_query($con, $cate_query);

    $cate_query = "INSERT INTO `categories` ( `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `popular`, `image`, `created_at`) 
    VALUES ( '$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keywords', '$status','$popular', '$filename', current_timestamp())";
    if($conn->query($cate_query)==true){
        header("Location: add_categories.php");
        exit();
    }
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
  <?php include 'components/admin_navbar.php';?>


    <div class="container mt-5 pt-5">
        <h1 class="mt-5 pt-5">Add New Category</h1>
         <div class="card-body">
                    <!-- Form to submit category details -->
                    <!-- 'multipart/form-data' allows file uploads -->
                    <form action="add_categories.php" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <!-- Category Name input -->
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                            </div>

                            <!-- Slug input (used in URLs) -->
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" placeholder="Enter slug" class="form-control">
                            </div>

                            <!-- Description textarea -->
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea rows="3" name="description" placeholder="Enter description" class="form-control"></textarea>
                            </div>

                            <!-- Image upload input -->
                            <div class="col-md-12">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <!-- Meta Title textarea (for SEO) -->
                            <div class="col-md-12">
                                <label for="">Meta title</label>
                                <textarea rows="3" name="meta_title" placeholder="Enter meta title" class="form-control"></textarea>
                            </div>

                            <!-- Meta Description textarea (for SEO) -->
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea rows="3" name="meta_description" placeholder="Enter meta description" class="form-control"></textarea>
                            </div>

                            <!-- Meta Keywords textarea (for SEO) -->
                            <div class="col-md-12">
                                <label for="">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" placeholder="Enter meta keywords" class="form-control"></textarea>
                            </div>

                            <!-- Status checkbox (checked = active, unchecked = inactive) -->
                            <div class="col-md-6">
                                <label for="">Status</label><br>
                                <input type="checkbox" name="status">
                            </div>

                            <!-- Popular checkbox (optional: if checked, highlight this category) -->
                            <div class="col-md-6">
                                <label for="">Popular</label><br>
                                <input type="checkbox" name="popular">
                            </div>

                            <!-- Submit button -->
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                            </div>

                        </div> <!-- End of row -->
                    </form>
                </div> <!-- End of card-body -->
    </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>