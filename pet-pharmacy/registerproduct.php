<?php
include('header.php');
$product = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_image = '';

    if (isset($_FILES["product_image"])) {
        $dir = "uploads/";
        $file = $dir . basename($_FILES["product_image"]["name"]);
        $upload_status = 1;
        $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $file)) {
            $product_image = $dir . basename($_FILES["product_image"]["name"]);
        }
    }

    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description =
        $_POST['product_description'];


    $sql = "INSERT INTO pharmacy_products (product_image, product_name, product_price, product_description)
        VALUES ('$product_image', '$product_name', $product_price, '$product_description')";

    if ($product_id) {
        if ($product_image == '') {
            $product_image = $_POST['product_image_path'];
        }
        $sql = "UPDATE pharmacy_products 
        SET product_name = '$product_name', 
            product_price = $product_price, 
            product_description = '$product_description',
            product_image = '$product_image'
        WHERE product_id = $product_id";
    }


    if ($mysqli->query($sql)) {
        if ($product_id) {
            header("Location:dashboard.php?success=Successfully updated product");
        } else {
            header("Location:registerproduct.php?success=true");
        }
    } else {
        header("Location:registerproduct.php?error=true");
    }
}

if (isset($_GET['prod_id'])) {
    $product_id = $_GET['prod_id'];
    $sql = "SELECT * FROM pharmacy_products WHERE product_id = $product_id";
    $result = $mysqli->query($sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $product = $row;
    }
}

if (isset($_GET['error'])) {
?>
    <section class="error-banner">
        <div class="container">
            <p class="MsoNormal m-0">There was an error creating the product.</p>
        </div>
    </section>
<?php
} else if (isset($_GET['success'])) {
?>
    <section class="success-banner">
        <div class="container">
            <p class="MsoNormal m-0">Successfully added product.</p>
        </div>
    </section>
<?php
}
?>
<div id="page-content">
    <section class="breadcrumnb">
        <div class="container">
            <ol class="clearfix">
                <li>

                    <a href="index.php"><span>Home</span></a>
                </li>
                <li>
                    <span>Product Registry</span>
                </li>
            </ol>
        </div>
    </section>

    <section class="page_header">
        <div class="container">
            <h1 class="page_heading">Product Registry</h1>

            <div class="group-message"></div>
        </div>
    </section>

    <section id="registration0" class="registration-page-content page-content">
        <div class="container">
            <div class="row">
                <div class="content-area col-lg-12">
                    <form action="registerproduct.php" method="post" autocomplete="on" enctype="multipart/form-data">
                        <?php
                        if (!is_null($product)) {
                        ?>
                            <input type="hidden" value="<?= $product['product_id'] ?>" name="product_id">
                            <input type="hidden" value="<?= $product['product_image'] ?>" name="product_image_path">

                        <?php
                        }
                        ?>
                        <div class="row">
                            <div class="accountRegForm accountRegForm-col col-lg-12">
                                <div class="row">
                                    <div class="form-field col-xs-12">
                                        <label for="product_image" class="validation-field">
                                            <span class="MsoNormal" style="color: #949494;">Product Image</span>
                                            <input <?= !is_null($product) ? '' : 'required' ?> name="product_image" type="file" class="form-control" placeholder="Product Image" accept="image/png, image/jpeg">
                                            <span class="required-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="form-field col-xs-12">
                                        <label for="product_name" class="validation-field">
                                            <input required name="product_name" type="text" class="form-control" placeholder="Product Name" value="<?= !is_null($product) ? $product['product_name'] : '' ?>">
                                            <span class="required-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="form-field col-xs-12">
                                        <label for="product_price" class="validation-field">
                                            <input required name="product_price" min="0" type="number" class="form-control" placeholder="Product Price" value="<?= !is_null($product)  ? $product['product_price'] : '' ?>">
                                            <span class="required-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="form-field col-xs-12">
                                        <label for="product_description" class="validation-field">
                                            <textarea name="product_description" class="form-control" required placeholder="Product Description"><?= !is_null($product)  ? $product['product_description'] : '' ?></textarea>
                                            <span class="required-indicator"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="accountRegForm accountRegForm-col col-lg-12">
                                <div class="submit-button text-right">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

<?php
include('footer.php');
?>