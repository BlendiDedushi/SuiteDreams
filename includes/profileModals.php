<!-- UpdateProfile -->
<div class="modal fade" id="uProfile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Profile</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group mb-4">
            <input type="text" name="username" required class="form-control" value="<?= $user['username'] ?>" />
          </div>
          <div class="form-group mb-4">
            <input type="email" name="email" required class="form-control" value="<?= $user['email'] ?>" />
          </div>
          <div class="form-group mb-4">
            <label for="avatar">Profile picture</label>
            <input type="file" name="avatar" id="avatar" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="update_profile" class="btn btn-outline-success">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- UpdatePassword -->
<div class="modal fade" id="uPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Password</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
          <div class="form-group mb-4">
            <input type="password" name="oldpassword" class="form-control" required
              placeholder="Enter your password..." />
          </div>
          <div class="form-group mb-4">
            <input type="password" name="password1" class="form-control" required
              placeholder="Enter your new password..." />
          </div>
          <div class="form-group mb-4">
            <input type="password" name="password2" class="form-control" required
              placeholder="Confirm your new password..." />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="update_password" class="btn btn-outline-success">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- CreateEstate -->
<div class="modal fade" id="cEstate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Estate</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
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
            <input type="file" name="photos[]" class="form-control" required multiple />
          </div>
          <div class="form-group mb-4 w-50">
            <input type="number" name="price" class="form-control" required placeholder="Estate price..." min="0" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <button name="createE" type="submit" class="btn btn-outline-success">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- EditEstate -->
<div class="modal fade" id="eEstate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Estate</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
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
            <input type="file" name="photos[]" class="form-control" required multiple />
          </div>
          <div class="form-group mb-4 w-50">
            <input type="number" name="price" class="form-control" required placeholder="Estate price..." min="0" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            <button name="credteE" type="submit" class="btn btn-outline-success">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>