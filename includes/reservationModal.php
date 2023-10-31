<div class="modal fade" id="reservationM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Make a Reservation</h1>
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
            <button name="createR" type="submit" class="btn btn-outline-success">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>