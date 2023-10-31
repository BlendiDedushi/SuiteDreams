<?php if (count($myestates)): ?>
  <div id="myestates" style="<?= isset($_POST['showMyEstates']) ? 'display: block;' : 'display: none;' ?>">
    <table class="table table-striped table-secondary table-hover">
      <thead>
        <tr>
          <th scope="col">My Estates</th>
          <th scope="col">Name</th>
          <th scope="col">Location</th>
          <th scope="col">Price</th>
          <th scope="col">Update/Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($myestates as $e): ?>
          <tr>
            <th scope="row">
              <?= $e['id'] ?>
            </th>
            <td>
              <?= $e['name'] ?>
            </td>
            <td>
              <?= $e['location'] ?>
            </td>
            <td>
              <?= $e['price'] ?>&euro;
            </td>
            <td>
              <div class="d-flex justify-content-around align-items-center">
                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal"
                  data-bs-target="#eEstate">
                  <i class="bi bi-pencil-square"></i>
                </button>
                <form method="POST">
                  <input type="hidden" name="deleteEstateId" value="<?= $e['id'] ?>">
                  <button type="submit" name="deleteEstate" class="btn btn-sm btn-outline-danger">
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