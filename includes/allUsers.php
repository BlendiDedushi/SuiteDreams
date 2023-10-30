<?php if (count($users)): ?>
      <div id="users" style="<?= isset($_POST['showUsers']) ? 'display: block;' : 'display: none;' ?>">
        <table class="table table-secondary table-hover">
          <thead>
            <tr>
              <th scope="col">All Users</th>
              <th scope="col">Username</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Update/Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $u): ?>
              <tr>
                <th scope="row">
                  <?= $u['id'] ?>
                </th>
                <td>
                  <?= $u['username'] ?>
                </td>
                <td>
                  <?= $u['email'] ?>
                </td>
                <td>
                  <?= $roleNames[$u['role_id']] ?>
                </td>
                <td class="text-center ">
                  <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-square"></i></button>
                  <form method="POST">
                    <input type="hidden" name="deleteUserId" value="<?= $u['id'] ?>">
                    <button type="submit" name="deleteUser" class="btn btn-sm btn-outline-danger">
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