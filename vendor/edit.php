<?php
include "../shared/connection.php";
include "authguard.php";

$pid = $_GET['pid'];  

// Fetch product details from the database based on the product ID
$query = "SELECT * FROM product WHERE pid='$pid'";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);  


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $detail = $_POST['detail'];
    
    
    if (!empty($_FILES['image']['name'])) {
        
        $filename = basename($_FILES['image']['name']);
        $impath = '../shared/images/' . $filename;

       
        if (move_uploaded_file($_FILES['image']['tmp_name'], $impath)) {
            // Update query with the new image path
            $query = "UPDATE product SET name='$name', price='$price', detail='$detail', impath='$impath' WHERE pid='$pid'";
        } else {
            echo "Error uploading file.";
        }
    } else {
        // Update query without changing the image
        $query = "UPDATE product SET name='$name', price='$price', detail='$detail' WHERE pid='$pid'";
    }

    // Execute the query to update the product
    if (mysqli_query($conn, $query)) {
        
        header("Location: view.php");
        exit();
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Edit Product</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form method="POST" class="w-50 bg-warning p-4" enctype="multipart/form-data">
            <h4 class="text-center">Edit Product</h4>
            
            <?php if (!empty($product['impath'])): ?>
                <div class="text-center mb-3">
                    <img src="<?php echo $product['impath']; ?>" alt="Current Image" class="img-fluid" style="max-height: 200px;">
                </div>
            <?php endif; ?>
            
            <input class="form-control mt-3" type="text" name="name" placeholder="Product Name" value="<?php echo $product['name']; ?>" required>
            <input class="form-control mt-2" type="number" name="price" placeholder="Product Price" value="<?php echo $product['price']; ?>" required>
            <textarea class="form-control mt-2" name="detail" cols="30" rows="3" placeholder="Product Description" required><?php echo $product['detail']; ?></textarea>
            <input name="image" class="form-control mt-2" type="file" accept=".jpg,.png">
            
            <div class="text-center mt-3">
                <button class="btn btn-danger">Update Product</button>
                <a href="view.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
