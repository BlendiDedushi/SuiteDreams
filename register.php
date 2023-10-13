<?php include 'includes/header.php' ?>
<section class="my-5">
    <div class="container">
        <div class="row">
        <div class="col-4">
            <img class="img-fluid" src="assets/images/register.png" alt="estate-search"/>
        </div>
        <div class="card mx-auto my-auto" style="width: 30rem;">
            <div class="card-body">
                <h5 class="card-title text-center mb-3">Sign Up</h5>
                <div class="card-text">
                    <form action="#" method="POST">
                        <div class="form-group mb-3">
                            <input type="text" name="username" class="form-control" required placeholder="Enter your username..." />
                            <!-- form-floating -->
                            <!-- <label for="floatingInput">Enter your username...</label> -->
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control" required placeholder="Enter your email..." />
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" name="password" class="form-control" required placeholder="Enter your password..." />
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-sm btn-outline-dark">Create Account <i class="bi bi-person-plus"></i></button>
                            <a href="login.php" class="link-secondary link-offset-2 link-underline-opacity-50 link-underline-opacity-100-hover">Login<i class="bi bi-arrow-bar-right"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php' ?>