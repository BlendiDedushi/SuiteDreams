<?php
if (count($users)): ?>
  <div id="users" style="<?= isset($_POST['showUsers']) ? 'display: block;' : 'display: none;' ?>">
    <table class="table table-secondary table-hover">
      <thead>
        <tr>
          <th scope="col">All Users</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Role</th>
          <th scope="col" class="text-end">EditRole/Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <?php if ($u['role_id'] == 3) continue; ?>
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
            <td>
              <div class="d-flex justify-content-around align-items-center gap-2">
                <form method="POST">
                  <input type="hidden" name="updateUserId" value="<?= $u['id'] ?>">
                  <select name="newRole">
                    <option value="1">User</option>
                    <option value="2">Agent</option>
                    <option value="3">Admin</option>
                  </select>
                  <button type="submit" name="updateUserRole" class="btn btn-sm btn-outline-info">
                  <i class="bi bi-pencil-square"></i>
                  </button>
                </form>
                <form method="POST">
                  <input type="hidden" name="deleteUserId" value="<?= $u['id'] ?>">
                  <button type="submit" name="deleteUser" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-person-x"></i>
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
