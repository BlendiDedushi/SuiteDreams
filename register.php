<?php
include 'includes/header.php';
include 'classes/database.php';

if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == true) {
    header('Location: profile.php?id=' . $_SESSION['id']);
}

$errors = [];

if (isset($_POST['register_btn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errors[] = 'Username is not valid!';
    }

    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false || empty($email)) {
        $errors[] = 'Email is not valid!';
    }

    if (empty($password) || strlen($password) < 6) {
        $errors[] = 'Password must be 6+ characters!';
    }

    if (count($errors) == 0) {
        $stm = $conn->prepare('INSERT INTO user (`username`,`email`,`password`) VALUES (?,?,?)');
        if ($stm->execute([$username, $email, password_hash($password, PASSWORD_BCRYPT)])) {
            $id = $conn->lastInsertId();
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['isloggedin'] = true;
            header('Location: profile.php?id=' . $id);
        } else {
            $errors[] = 'Something went wrong while creating user - please try again!';
        }
    }
}


?>
<section class="my-5">
    <div class="container p-5">
        <div class="row">
            <div class="col-4">
                <img class="img-fluid" src="assets/images/register.png" alt="estate-search" />
            </div>
            <div class="card mx-auto my-auto" style="width: 30rem;">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3">Sign Up</h5>
                    <?php if (count($errors)) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php foreach ($errors as $error) : ?>
                                <p class="p-0 m-0"><?= $error ?>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="card-text">
                        <form action="#" method="POST">
                            <div class="form-group mb-3">
                                <input type="text" name="username" class="form-control" required placeholder="Enter your username..." />
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" name="email" class="form-control" required placeholder="Enter your email..." />
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="password" class="form-control" required placeholder="Enter your password..." />
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" name="register_btn" class="btn btn-sm btn-outline-dark">Create Account <i class="bi bi-person-plus"></i></button>
                                <a href="login.php" class="link-secondary link-offset-2 link-underline-opacity-50 link-underline-opacity-100-hover">Login<i class="bi bi-arrow-bar-right"></i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="fixed-bottom">
    <?php include 'includes/footer.php' ?>
</div>