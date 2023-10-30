<?php
include 'includes/header.php';
include 'classes/userCRUD.php';
include 'classes/estatesCRUD.php';

if (!isset($_SESSION['isloggedin'])) {
  header('Location: login.php');
}


$userCrud = new UserCrud($conn);
$estatesCrud = new EstatesCrud($conn);

if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
  $user = $userCrud->getUserById($id);
  $estates = $estatesCrud->getAllEstates();
  $users = $userCrud->getAllUsers();
  $myestates = $estatesCrud->getEstatesByUserId($id);
}

if (isset($_POST['createE'])) {
  $name = $_POST['name'];
  $desc = $_POST['desc'];
  $location = $_POST['location'];
  $lat = $_POST['lat'];
  $long = $_POST['long'];
  $price = $_POST['price'];

  $stm = $conn->prepare('INSERT INTO `estate` (`name`,`desc`,`location`,`lat`,`long`,`price`,`created_by`) VALUES (?,?,?,?,?,?,?)');
  $stm->execute([$name, $desc, $location, $lat, $long, $price, $id]);
  $estate_id = $conn->lastInsertId();

  if (isset($_FILES['photos'])) {
    for ($i = 0; $i < count($_FILES['photos']['name']); $i++) {
      $filename = time() . "-" . $_FILES['photos']['name'][$i];
      $stm = $conn->prepare('INSERT INTO `image` (`estate_id`,`image`) VALUES (?,?)');
      $stm->execute([$estate_id, $filename]);
      move_uploaded_file($_FILES['photos']['tmp_name'][$i], 'estates/' . $filename);
    }
  }
  header('Location: profile.php');
}

$roleNames = [
  1 => 'User',
  2 => 'Agent',
  3 => 'Admin',
];

if (isset($_POST['deleteEstate'])) {
  $deleteEstateId = $_POST['deleteEstateId'];
  $delEstate = $estatesCrud->deleteEstate($deleteEstateId);
  header("Location: profile.php");
}
if (isset($_POST['deleteUser'])) {
  $deleteUserId = $_POST['deleteUserId'];
  $delUser = $userCrud->deleteUser($deleteUserId);
  header("Location: profile.php");
}


?>
<form method="POST">
  <?php if ($user['role_id'] == 2): ?>
    <section class="bg-secondary p-2">
      <div class="d-flex justify-content-end gap-2">
        <button type="submit" name="showMyEstates" class="btn btn-sm btn-outline-light">
          My Estates <i class="bi bi-house-down"></i>
        </button>
        <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#cEstate">
          Create Estate <i class="bi bi-house-add"></i>
        </button>
      </div>
    </section>
  <?php endif; ?>
</form>

<form method="POST">
  <?php if ($user['role_id'] == 3): ?>
    <section class="bg-secondary p-2">
      <div class="d-flex justify-content-end gap-2">
        <button type="submit" name="showUsers" class="btn btn-sm btn-outline-light">
          Show Users <i class="bi bi-person-down"></i>
        </button>
        <button type="submit" name="showEstates" class="btn btn-sm btn-outline-light">
          Show Estates <i class="bi bi-house-down"></i>
        </button>
      </div>
    </section>
  <?php endif; ?>
</form>

<section class="bg-dark p-3">
  <div class="container d-flex justify-content-between">
    <div>
      <div class="card p-2 bg-transparent mb-2" style="width: 15rem;">
        <div class="d-flex justify-content-center align-items-center">
          <img src="<?= $user['avatar'] ?>" class="img-thumbnail rounded-circle" style="width: 100px;"
            alt="profile_img">
        </div>
        <div class="card-body text-center">
          <p class="p-0 m-0 mb-2 text-white fw-semibold">
            <?= $user['username'] ?>
          </p>
          <p class="p-0 m-0 text-white fst-italic">
            <?= $user['email'] ?>
          </p>
        </div>
      </div>
      <div class="d-flex gap-2">
        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#uProfile">
          Update Profile
        </button>
        <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#uPassword">
          Update Password
        </button>
      </div>
    </div>
    <?php include 'includes/myEstates.php' ?>
    <?php include 'includes/allUsers.php' ?>
    <?php include 'includes/allEstates.php' ?>
  </div>
</section>
<?php include 'includes/profileModals.php' ?>
<div class="fixed-bottom">
  <?php include 'includes/footer.php' ?>
</div>