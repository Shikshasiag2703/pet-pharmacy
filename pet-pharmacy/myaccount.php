<?php
include('header.php');

if (isset($_SESSION['username'])) {
    header("Location:index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email =  $_POST['email'];
    $password =  $_POST['password'];

    $sql = "SELECT id, first_name, last_name, email FROM users WHERE email = '$email' and password  = '$password'";
    $result = $mysqli->query($sql);
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['first_name'] . ' ' . $row['last_name'];
            $_SESSION['email'] = $row['email'];
            header("Location:dashboard.php");
        } else {
            header("Location:myaccount.php?error=true");
        }
    } else {
        header("Location:myaccount.php?error=true");
    }
}
if (isset($_GET['error'])) {
?>
    <section class="error-banner">
        <div class="container">
            <p class="MsoNormal m-0">Your account does not exist.</p>
        </div>
    </section>
<?php
}
?>
<div class="page-content">
    <section class="login-page-content page-content">
        <section class="breadcrumnb" aria-label="breadcrumb" role="main">
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
        <div class="container">
            <div class="row">
                <div class="content-area col-lg-12">
                    <div class="beta-col col-lg-6 col-md-6">
                        <div class="header">
                            <h2 class="headerTitle">New User</h2>
                        </div>
                        <div class="createNewAccount pad10">
                            <div class="height" style="min-height: 133px;">
                                <div class="form-field">
                                    <div class="MsoNormal">If you do not already have an account, please continue first-time signup by clicking the button below.
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="submit-button">
                                <a href="createaccount.php"> <button type="button" class="btn btn-primary">Create Account</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="alpha-col col-lg-6 col-md-6">
                        <div class="header">
                            <h2 class="headerTitle">Existing User</h2>
                        </div>
                        <div class="myaccountLogin pad10">
                            <form action="myaccount.php" class="bt-flabels js-flabels" method="post">
                                <input type="hidden" name="catalogid" value="0">
                                <div class="height" style="min-height: 133px;">
                                    <div class="form-field">
                                        <div class="MsoNormal">Please log in to your account.</div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="form-field">
                                        <label for="email" class="validation-field">
                                            <span class="hidden">Email:</span>
                                            <input required type="email" name="email" id="loginEmail" value="" placeholder="Email" size="30" tabindex="0" class="form-control">
                                            <span class="required-indicator" role="presentation"></span>
                                        </label>
                                    </div>
                                    <div class="form-field">
                                        <label for="password" class="validation-field">
                                            <span class="hidden">Password:</span>
                                            <input required type="password" name="password" autocomplete="off" placeholder="Password" class="form-control">
                                            <span class="required-indicator" role="presentation"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-field">
                                    <div class="submit-button">
                                        <button type="submit" id="submitted" name="submitted" class="btn btn-primary">Log in to my account</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

    </section>
</div>
<?php
include('footer.php');
?>