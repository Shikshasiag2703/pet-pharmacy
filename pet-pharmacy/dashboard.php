<?php
include('header.php');
if (!isset($_SESSION['username'])) {
    header("Location:index.php");
    exit();
}
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'users';
$products = [];
$users = [];

if ($_SESSION['email'] == 'admin@petpharmacy.com') {
    $user_query =  "SELECT * FROM users WHERE email != 'admin@petpharmacy.com'";
    $r = $mysqli->query($user_query);

    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_assoc($r)) {
            $users[] = $row;
        }
    }
}

$sql = "SELECT * FROM pharmacy_products";
$result = $mysqli->query($sql);


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
}
if (isset($_GET['error'])) {
?>
    <section class="error-banner">
        <div class="container">
            <p class="MsoNormal m-0"><?= $_GET['error'] ?></p>
        </div>
    </section>
<?php
} else if (isset($_GET['success'])) {
?>
    <section class="success-banner">
        <div class="container">
            <p class="MsoNormal m-0"><?= $_GET['success'] ?></p>
        </div>
    </section>
<?php
}
?>
<div class="page-content">
    <section class="login-page-content page-content">
        <section class="breadcrumnb">
            <div class="container">
                <ol class="clearfix">
                    <li>
                        <a href="/"><span>Home</span></a>
                    </li>
                    <li>
                        <span>My Account</span>
                    </li>
                </ol>
            </div>
        </section>
        <section class="page_header">
            <div class="container">
                <h1 class="page_heading">My Account</h1>

            </div>
        </section>
        <section class="page-content">
            <div class="container">
                <div class="h3">Welcome, <?= $_SESSION['username'] ?></div>


                <?php
                if ($_SESSION['email'] == 'admin@petpharmacy.com') {
                ?>
                    <nav id="rTabs" class="rTabs r-tabs" aria-label="product tabs" role="presentation">
                        <ul class="r-tabs-nav">
                            <li class="r-tabs-tab r-tabs-state-active"><a href="dashboard.php?tab=users" class="r-tabs-anchor <?= $active_tab == 'users' ?  'r-tabs-anchor-active' : '' ?>">Users</a></li>
                            <li class="r-tabs-tab r-tabs-state-active"><a href="dashboard.php?tab=products" class="r-tabs-anchor <?= $active_tab == 'products' ?  'r-tabs-anchor-active' : '' ?>">Products</a></li>
                        </ul>
                        <div id="tab-1" class="r-tabs-panel r-tabs-state-active" style="display: block;">
                            <div class="item">
                                <?php
                                if ($active_tab == 'users') {
                                ?>
                                    <table id="users-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($users as $user) {
                                            ?>
                                                <tr>
                                                    <td><?= $user['id']  ?></td>
                                                    <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                                                    <td><?= $user['email']  ?></td>
                                                    <td><?= $user['phone']  ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else {
                                ?>
                                    <table id="products-table">
                                        <thead>
                                            <tr>
                                                <th>Product ID</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Product Image</th>
                                                <th>Product Description</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($products as $prod) {
                                            ?>
                                                <tr>
                                                    <td><?= $prod['product_id']  ?></td>
                                                    <td><?= $prod['product_name']  ?></td>
                                                    <td>$<?= $prod['product_price']  ?></td>
                                                    <td><img src="<?= $current_url . $prod['product_image'] ?>" alt="<?= $prod['product_name']  ?>" width="40" height="40" /></td>
                                                    <td><?= $prod['product_description']  ?></td>
                                                    <td>
                                                        <a style="color: black;width: fit-content;" href="registerproduct.php?prod_id=<?= $prod['product_id'] ?>"><button class="btn">Edit</button></a>
                                                        <button style="width: fit-content;" class="btn" onclick="deleteProduct(<?= $prod['product_id'] ?>)">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </nav>
                <?php
                } else {
                ?>
                    <div class="table-container">
                        <table id="products-table">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Image</th>
                                    <th>Product Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($products as $prod) {
                                ?>
                                    <tr>
                                        <td><?= $prod['product_id']  ?></td>
                                        <td><?= $prod['product_name']  ?></td>
                                        <td>$<?= $prod['product_price']  ?></td>
                                        <td><img src="<?= $current_url . $prod['product_image'] ?>" alt="<?= $prod['product_name']  ?>" width="40" height="40" /></td>
                                        <td><?= $prod['product_description']  ?></td>
                                        <td>
                                            <a style="color: black;width: fit-content;" href="registerproduct.php?prod_id=<?= $prod['product_id'] ?>"><button class="btn">Edit</button></a>
                                            <button style="width: fit-content;" class="btn" onclick="deleteProduct(<?= $prod['product_id'] ?>)">Delete</button>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                }
                ?>
            </div>
        </section>
    </section>
</div>
<?php

include('footer.php');
?>