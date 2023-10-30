<?php
include 'includes/header.php';
include 'classes/estatesCRUD.php';

if (!isset($_SESSION['isloggedin'])) {
    header('Location: login.php');
}

$estatesCrud = new EstatesCrud($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $estate = $estatesCrud->getEstateById($id);
    $avgRating = $estatesCrud->getAverageRatingForEstate($id);
    $image = $estatesCrud->getAllImages($id);
} else {
    die('<div class="alert alert-info text-center mx-5 my-5" role="alert">
            Estate does not exist!
        </div>');
}
?>
<section>
    <div>
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <?php foreach ($image as $index => $img): ?>
                    <div class="carousel-item <?php if ($index === 0)
                        echo 'active'; ?>">
                        <img src="estates/<?= $img['image'] ?>" class="d-block w-100" alt="...">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>

<?php
if ($avgRating > 0) {
    echo '<p class="card-text">' . number_format($avgRating, 1) . '</p>';
}
?>


<div class="fixed-bottom">
    <?php include 'includes/footer.php' ?>
</div>