    INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `status`, `popular`, `image`, `created_at`) 
    
    
    VALUES (NULL, 'Jeans', 'Jeans', 'Jeans best ', 'Jeans', 'Jeans', 'Jeans', '1', '1', '1750951232.jpg', '2025-06-26 20:50:32');
else{
 echo"connection okayy";
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

handle update submission
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



    Handle image upload
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
        // -- category_id = '$category_id',
        // name = '$name',
        // slug = '$slug',
        // description = '$description',
        // image = '$filename',
        // status = '$status',
        // popular = '$popular',
        // meta_title = '$meta_title',
        // meta_keywords = '$meta_keywords',
        // meta_description = '$meta_description'
        // WHERE id = '$category_id'";
 //
    // Redirect to the categories page with a success message
    // $_SESSION['message'] = "Category Updated Successfully";
    // header("Location: added_categories.php");
    // exit();
    
    // }