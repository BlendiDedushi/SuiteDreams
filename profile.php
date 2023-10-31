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

if (isset($_POST['update_profile'])) {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $filename = '';

  if (isset($_FILES['avatar'])) {
    $filename = time() . "-" . $_FILES['avatar']['name'];
    move_uploaded_file($_FILES['avatar']['tmp_name'], 'avatars/' . $filename);
  }

  if (!empty($filename)) {
    $stm = $conn->prepare('UPDATE `user` SET `username`=?, `email`=?, `avatar`=? WHERE `user`.id=?');
    $stm->execute([$username, $email, $filename, $id]);
  } else {
    if (!empty($username) && !empty($email)) {
      $stm = $conn->prepare('UPDATE `user` SET `username`=?, `email`=? WHERE `user`.id=?');
      $stm->execute([$username, $email, $id]);
    }
  }
  header("Location: profile.php");
}

$errors=[];
if (isset($_POST['update_password'])) {
  $oldpassword = $_POST['oldpassword'];
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];

  if ($password1 == $password2) {
    if (password_verify($oldpassword, $user['password'])) {
      $stm = $conn->prepare('UPDATE `user` SET `password`=? WHERE `user`.id=?');
      $stm->execute([password_hash($password1, PASSWORD_BCRYPT),$id]);
      header("Location: profile.php?status=1");
    }else{
      $errors[] = 'Password wrong!';
    }
  } else {
    $errors[] = 'Password isnt matching!';
  }
  header("Location: profile.php");
}

// if (isset($_POST['update_role'])) {
//   $urole = isset($_POST['urole']) ? $_POST['urole'] : null;
//   $upUser = isset($_POST['upUser']) ? $_POST['upUser'] : null;

//   if (!empty($urole) && !empty($upUser)) {
//     $stm = $conn->prepare('UPDATE `user` SET `role_id`=? WHERE `user`.id=?');
//     $stm->execute([$urole, $upUser]);
//     header("Location: profile.php");
//   } else {
//     $errors[] = "Invalid input or user not found.";
//   }
// }



?>
<form method="POST">
  <?php if ($user['role_id'] == 1): ?>
    <section class="bg-secondary p-2">
      <div class="d-flex justify-content-end gap-2">
        <?php if (count($myestates) > 0): ?>
          <button type="submit" name="showMyEstates" class="btn btn-sm btn-outline-light">
            My Estates <i class="bi bi-house-down"></i>
          </button>
        <?php endif; ?>
        <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#cEstate">
          Create Estate <i class="bi bi-house-add"></i>
        </button>
      </div>
    </section>
  <?php endif; ?>
</form>

<form method="POST">
  <?php if ($user['role_id'] == 2): ?>
    <section class="bg-secondary p-2">
      <div class="d-flex justify-content-end gap-2">
        <?php if (count($myestates) > 0): ?>
          <button type="submit" name="showMyEstates" class="btn btn-sm btn-outline-light">
            My Estates <i class="bi bi-house-down"></i>
          </button>
        <?php endif; ?>
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

<section class="p-3" style="height:85vh; background: rgb(0,0,0);
background: linear-gradient(9deg, rgba(0,0,0,1) 0%, rgba(69,107,107,0.9767981438515081) 44%, rgba(158,114,7,1) 100%);">
  <div class="container d-flex justify-content-between">
    <div>
      <div class="card p-2 bg-transparent mb-2" style="width: 15rem;">
        <div class="d-flex justify-content-center align-items-center">
          <?php
          if (!empty($user['avatar'])) {
            echo '<img src="avatars/' . $user['avatar'] . '" class="img-thumbnail rounded-circle" style="width: 100px; height: 100px;" alt="profile_img">';
          } else {
            echo '<img src="https://media.istockphoto.com/id/1451587807/vector/user-profile-icon-vector-avatar-or-person-icon-profile-picture-portrait-symbol-vector.jpg?s=612x612&w=0&k=20&c=yDJ4ITX1cHMh25Lt1vI1zBn2cAKKAlByHBvPJ8gEiIg=" class="img-thumbnail rounded-circle" style="width: 100px; height: 100px;" alt="profile_img">';
          }
          ?>

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
      <?php if (count($errors)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?php foreach ($errors as $error): ?>
            <p class="p-0 m-0">
              <?= $error ?>
            <?php endforeach; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
      <?php if (isset($_GET['status']) && ($_GET['status'] == 1)): ?>
        <div class="mt-2 alert alert-success alert-dismissible fade show" role="alert">
            <p class="p-0 m-0">
              Password was updated succesfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      <?php endif; ?>
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