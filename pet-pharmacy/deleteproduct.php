<?php
include('connection.php');

if (!isset($_SESSION['username'])) {
    echo "Unauthorized";
    exit();
}

$product_id = $_GET['prod_id'];

$sql = "DELETE FROM pharmacy_products WHERE product_id = $product_id";

if ($mysqli->query($sql)) {
    header("Location:dashboard.php?success=Successfully deleted product");
} else {
    header("Location:dashboard.php?error=Product delete failed");
}
