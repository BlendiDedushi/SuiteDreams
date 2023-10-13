<?php 
include 'includes/header.php';
include 'classes/database.php';

if(!isset($_SESSION['isloggedin'])){
  header('Location: index.php');
}
?>

<section class="bg-dark">
  <div class="p-5">
    
  
  
  <div class="container">
      <div class="row">
        <div class="col-5">
          <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#uProfile">
            Update Profile
          </button>
          <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#uPassword">
            Update Password
          </button>
        </div>
      </div>
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
            <input type="email" name="email" readonly class="form-control" value="myemail@gmail.com" />
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

<?php include 'includes/footer.php' ?>