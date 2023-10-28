<?php 
include 'includes/header.php';
include 'classes/userCRUD.php';

if(!isset($_SESSION['isloggedin'])){
  header('Location: login.php');
}

$userCrud = new UserCrud($conn);

if(isset($_SESSION['id'])){
  $id = $_SESSION['id'];
  $user = $userCrud->getUserById($id);
}
?>
<section class="bg-secondary p-2">
  <div class="d-flex justify-content-end">
    <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#cEstate">
      Create Estate <i class="bi bi-house-add"></i>
    </button>
  </div>
</section>
<section class="bg-dark p-3">
  <div class="container">
    <div class="card p-2 bg-transparent mb-2" style="width: 15rem;">
      <div class="d-flex justify-content-center align-items-center">
        <img src="<?= $user['avatar'] ?>" class="img-thumbnail rounded-circle" style="width: 100px;" alt="profile_img">
      </div>
      <div class="card-body text-center"> 
          <p class="p-0 m-0 mb-2 text-white fw-semibold"><?= $user['username'] ?></p>
          <p class="p-0 m-0 text-white fst-italic"><?= $user['email'] ?></p>
      </div>
    </div>
    <div class="w-25 d-flex gap-2">
      <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#uProfile">
       Update Profile
      </button>
      <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#uPassword">
        Update Password
      </button>
    </div>
  </div>
</section>

<!-- UpdateProfile -->
<div class="modal fade" id="uProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <div class="form-group mb-4">
            <input type="text" name="username" class="form-control" placeholder="Change username..." />
          </div>
          <div class="form-group mb-4">
            <input type="email" name="email" readonly class="form-control" value="<?= $user['email'] ?>" />
          </div>
          <div class="form-group mb-4">
            <label for="avatar">Profile picture</label>
            <input type="file" name="avatar" id="avatar"/>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- UpdatePassword -->
<div class="modal fade" id="uPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          <div class="form-group mb-4">
            <input type="password" name="oldpassword" class="form-control" required placeholder="Enter your password..." />
          </div>
          <div class="form-group mb-4">
            <input type="password" name="newpassword" class="form-control" required placeholder="Enter your new password..." />
          </div>
          <div class="form-group mb-4">
            <input type="password" name="newpassword" class="form-control" required placeholder="Confirm your new password..." />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- CreateEstate -->
<div class="modal fade" id="cEstate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Estate</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data">
            <div class="d-flex gap-1">
                <div class="form-group mb-4 w-50">
                  <input type="text" name="name" class="form-control" required placeholder="Estate name..." />
                </div>
                <div class="form-group mb-4 w-50">
                  <input type="text" name="location" class="form-control" required placeholder="Estate location..." />
                </div>
            </div>
            <div class="form-group mb-4">
                <textarea name="desc" class="form-control" placeholder="Description..."></textarea>
            </div>
            <div class="d-flex gap-1">
                <div class="form-group mb-4 w-50">
                  <input type="text" name="lat" class="form-control" placeholder="Latitude..." />
                </div>
                <div class="form-group mb-4 w-50">
                  <input type="text" name="long" class="form-control" placeholder="Longitude..." />
                </div>
            </div>
            <div class="form-group mb-4">
                <input type="file" name="files[]" class="form-control" required multiple/>
            </div>
            <div class="form-group mb-4 w-50">
                  <input type="text" name="price" class="form-control" required placeholder="Estate price..." />
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-success">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="fixed-bottom">
    <?php include 'includes/footer.php' ?>
</div>