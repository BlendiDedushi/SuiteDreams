<?php if (count($myreservations)): ?>
  <div id="myreservations" style="<?= isset($_POST['showMyReservations']) ? 'display: block;' : 'display: none;' ?>">
    <table class="table table-striped table-secondary table-hover">
      <thead>
        <tr>
          <th scope="col">My Reservations</th>
          <th scope="col">Estate</th>
          <th scope="col">Check In</th>
          <th scope="col">Check Out</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($myreservations as $r): ?>
          <tr>
            <th scope="row">
              <?= $r['id'] ?>
            </th>
            <td class="text-center">
              <?= $r['estate_id'] ?>
            </td>
            <td class="text-center">
              <?= $r['check_in_date'] ?>
            </td>
            <td class="text-center">
              <?= $r['check_out_date'] ?>
            </td>
            <td>
              <div class="d-flex justify-content-around align-items-center">
                <form method="POST">
                  <input type="hidden" name="deleteReservationId" value="<?= $r['id'] ?>">
                  <button type="submit" name="deleteReservation" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-house-x"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>