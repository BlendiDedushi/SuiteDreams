<div class="modal fade" id="reservationM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Make a Reservation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="hidden" name="eid" value="<?= $id ?>">
          <div class="d-flex gap-1">
            <div class="form-group mb-4 w-50">
              <input type="date" name="checkin" class="form-control" required placeholder="Check-in date..." />
            </div>
            <div class="form-group mb-4 w-50">
              <input type="date" name="checkout" class="form-control" required placeholder="Check-out date..." />
            </div>
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