<?php if (count($estates)): ?>
  <div id="estates" style="<?= isset($_POST['showEstates']) ? 'display: block;' : 'display: none;' ?>">
    <table class="table table-secondary table-hover">
      <thead>
        <tr>
          <th scope="col">All Estates</th>
          <th scope="col">Name</th>
          <th scope="col">Location</th>
          <th scope="col">Price</th>
          <th scope="col">Created_by</th>
          <th scope="col">Update/Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($estates as $e): ?>
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
              <?= $e['price'] ?>
            </td>
            <td>
              <?= $e['created_by'] ?>
            </td>
            <td class="text-center">
              <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-square"></i></button>
              <form method="POST">
                <input type="hidden" name="deleteEstateId" value="<?= $e['id'] ?>">
                <button type="submit" name="deleteEstate" class="btn btn-sm btn-outline-danger">
                  <i class="bi bi-person-x"></i>
                </button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>