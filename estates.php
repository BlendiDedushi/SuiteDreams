<?php
include 'includes/header.php';
include 'classes/estatesCRUD.php';

$estatesCrud = new EstatesCrud($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sortBy = $_POST['sort'];
    if (isset($_POST['search'])) {
        $searchTerm = $_POST['search'];
    } else {
        $searchTerm = "";
    }
    
    if ($sortBy === 'name') {
        $estates = $estatesCrud->getAllEstatesSortedByName();
    } elseif ($sortBy === 'price') {
        $estates = $estatesCrud->getAllEstatesSortedByPrice();
    } else {
        $estates = $estatesCrud->getAllEstates();
    }

    if (!empty($searchTerm)) {
        $estates = array_filter($estates, function ($estate) use ($searchTerm) {
            return strpos(strtolower($estate['name']), strtolower($searchTerm)) !== false;
        });
    }
} else {
    $estates = $estatesCrud->getAllEstates();
}
?>
<div class="my-4 w-25">
    <form method="post" action="">
        <div class="d-flex gap-2">
            <label for="sort" class="mr-2 "></label>
            <select name="sort" id="sort" class="form-control fw-light fst-italic w-25 mr-2 bg-dark text-light ">
                <option value="" selected>Sort by:</option>
                <option value="name">Name</option>
                <option value="price">Price</option>
            </select>
            <input type="text" name="search" class="form-control w-50" placeholder="Search by Name">
            <button type="submit" class="btn btn-sm btn-outline-dark">Sort/Search Estates</button>
        </div>
    </form>
</div>

<div class="container row mx-auto">
    <?php if (count($estates)): ?>
        <?php foreach ($estates as $estate): ?>
            <?php
            $avgRating = $estatesCrud->getAverageRatingForEstate($estate['id']);
            $image = $estatesCrud->getAllImages($estate['id']);
            $firstImageName = $image[0]['image'];
            ?>
            <div class="card m-3" style="width: 18rem;">
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
