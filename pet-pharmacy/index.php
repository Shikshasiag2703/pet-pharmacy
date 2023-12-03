<?php
include('header.php');

$sql = "SELECT * FROM pharmacy_products";
$result = $mysqli->query($sql);

$products = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
?>

<div class="page-content">
    <section class="homepage container">
        <a href="" tabindex="-1">
            <img class="w-100" src="./images/banner.png" alt="banner" style="max-height: 600px;">
        </a>
    </section>
    <div class="products-section">
        <section class="page_header">
            <div class="container">
                <h1 class="page_heading">Products</h1>
            </div>
        </section>
        <div class="container">
            <?php
            if (sizeof($products) > 0) {
            ?>
                <div class="product-items">
                    <?php
                    foreach ($products as $product) {
                    ?>
                        <div class="product-item">
                            <div class="img">
                                <img src="<?= $current_url . $product['product_image'] ?>" alt="<?= $product['product_name'] ?>" class="img-responsive">
                            </div>
                            <div class="product-content">
                                <div class="name">
                                    <?= $product['product_name'] ?>
                                </div>
                                <div class="description">
                                    <?= $product['product_description'] ?>
                                </div>
                                <div class="price">
                                    $ <?= $product['product_price'] ?>
                                </div>
                                <!-- <button class="w-100 btn btn-primary" onclick="alert('Coming soon')">Add to cart</button> -->
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
            <?php
            } else {
            ?>
                <div class="empty-message w-100">
                    <p class="MsoNormal">No products found</p>
                    <a href="registerproduct.php"> <button class="btn btn-default">Add Product</button></a>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div>

<?php
include('footer.php');
?>