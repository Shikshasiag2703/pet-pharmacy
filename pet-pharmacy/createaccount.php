<?php
include('header.php');

if (isset($_SESSION['username'])) {
    header("Location:index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname =  $_POST['firstname'];
    $lastname =  $_POST['lastname'];
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    $phone =  $_POST['phone'];


    $sql = "INSERT INTO users (first_name, last_name, email, password, phone)
        VALUES ('$firstname', '$lastname', '$email', '$password', '$phone')";

    if ($mysqli->query($sql)) {
        $_SESSION['username'] = $firstname . ' ' . $lastname;
        $_SESSION['email'] = $email;
        header("Location:dashboard.php");
    } else {
        header("Location:createaccount.php?error=true");
    }
}
if (isset($_GET['error'])) {
?>
    <section class="error-banner">
        <div class="container">
            <p class="MsoNormal m-0">There was an error creating your account.</p>
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
                    <span>Create an Account</span>
                </li>
            </ol>
        </div>
    </section>

    <section class="page_header">
        <div class="container">
            <h1 class="page_heading">Create an Account</h1>

            <div class="group-message"></div>
        </div>
    </section>

    <section id="registration0" class="registration-page-content page-content">
        <div class="container">
            <div class="row">
                <div class="content-area col-lg-12">
                    <form action="createaccount.php" method="post" autocomplete="on">
                        <div class="row">
                            <div class="accountRegForm accountRegForm-col col-lg-12">
                                <div class="row">
                                    <div class="form-field col-sm-6">
                                        <label for="firstname" class="validation-field">
                                            <input name="firstname" type="text" id="shipping_firstname" class="form-control" placeholder="First Name" required>
                                            <span class="required-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="form-field col-sm-6">
                                        <label for="lastname" class="validation-field">
                                            <input name="lastname" type="text" class="form-control" placeholder="Last Name" required>
                                            <span class="required-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="form-field col-xs-12">
                                        <label for="phone" class="validation-field">
                                            <input required name="phone" type="tel" class="form-control" placeholder="Phone">
                                            <span class="required-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="form-field col-lg-12">
                                        <label for="email" class="validation-field">
                                            <input type="email" size="25" name="email" required class="form-control" placeholder="Email">
                                            <span class="required-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="form-field col-lg-12">
                                        <label for="password" class="validation-field">
                                            <input type="password" size="12" name="password" required class="form-control" placeholder="Password">
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