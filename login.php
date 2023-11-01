<?php
include 'includes/header.php';
include 'classes/database.php';

if (isset($_SESSION['isloggedin']) && $_SESSION['isloggedin'] == true) {
    header('Location: profile.php?id=' . $_SESSION['id']);
}

$errors = [];

if (isset($_POST['login_btn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        $errors[] = 'Username is not valid!';
    }

    if (empty($password) || strlen($password) < 6) {
        $errors[] = 'Password is not valid!';
    }

    if (count($errors) == 0) {
        $stm = $conn->prepare('SELECT * FROM `user` WHERE `username`=?');
        $stm->execute([$username]);
        $user = $stm->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $errors[] = 'User does not exist!';
        } else {
            if (password_verify($password, $user['password'])) {
                $id = $user['id'];
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['isloggedin'] = true;
                header('Location: profile.php?id=' . $id);
            } else {
                $errors[] = 'Incorrect password!';
            }
        }
    }
}

?>
<section class="my-5" style="height: 78vh;">
    <div class="container p-5">
        <div class="row">
            <div class="col-4">
                <img class="img-fluid" src="assets/images/login.png" alt="estate-search" />
            </div>
            <div class="card mx-auto my-auto" style="width: 30rem;">
                <div class="card-body">
                    <h5 class="card-title text-center mb-3">Login</h5>
                    <?php if (count($errors)): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?php foreach ($errors as $error): ?>
                                <p class="p-0 m-0">
                                    <?= $error ?>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="card-text">
                        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group mb-3">
                                <input type="text" name="username" class="form-control" required
                                    <?= isset($_POST['username']) ? 'value="' . htmlspecialchars($_POST['username']) . '"' : '' ?> placeholder="Enter your username..." />
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" name="password" class="form-control" required
                                    placeholder="Enter your password..." />
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" name="login_btn" class="btn btn-sm btn-outline-dark">Login <i
                                        class="bi bi-person-check"></i></button>
                                <a href="register.php"
                                    class="link-secondary link-offset-2 link-underline-opacity-50 link-underline-opacity-100-hover">Sign
                                    Up<i class="bi bi-arrow-bar-right"></i></a>
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