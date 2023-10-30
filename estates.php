<?php
include 'includes/header.php';
include 'classes/estatesCRUD.php';

$estatesCrud = new EstatesCrud($conn);
$estates = $estatesCrud->getAllEstates();
?>

<div class="container row">
    <?php if (count($estates)): ?>
        <?php foreach ($estates as $estate): ?>
            <?php
            $avgRating = $estatesCrud->getAverageRatingForEstate($estate['id']);
            $image = $estatesCrud->getAllImages($estate['id']);
            $firstImageName = $image[0]['image'];
            ?>
            <div class="card m-3 ecard">
                <img src="estates/<?= $firstImageName ?>" class="py-2" alt="estate-card" style="height: 25vh;">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $estate['name'] ?>
                    </h5>
                    <p class="card-text">
                        <?= $estate['location'] ?> |
                        <?= $estate['price'] ?>&euro;
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <?php
                        if ($avgRating > 0) {
                            echo '<p class="card-text">' . number_format($avgRating, 1) . '</p>';
                        }
                        ?>
                        <a href="estate.php?id=<?= $estate['id'] ?>" class="btn btn-sm btn-outline-dark"><i
                                class="bi bi-box-arrow-in-right"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php' ?>