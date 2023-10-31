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
<section class="text-light" style="background: rgb(28,30,31);
background: linear-gradient(340deg, rgba(28,30,31,1) 0%, rgba(89,72,40,1) 48%, rgba(170,114,8,1) 100%);" >
    <div class="d-flex justify-content-between p-3">
        <div class="col-7">
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <?php foreach ($image as $index => $img): ?>
                        <div class="carousel-item <?php if ($index === 0)
                            echo 'active'; ?>">
                            <img src="estates/<?= $img['image'] ?>" class="d-block w-100" alt="..." style="height: 50vh;">
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div>
            <div id="map"></div>
        </div>
    </div>
    <div class="p-3 d-flex justify-content-between">
        <div class="col-7 p-3">
            <h3 class="text-center fw-semibold fst-italic">
                -
                <?= $estate['name'] ?>-
            </h3>
            <p class="fst-italic">
                <span class="fw-semibold">Description: </span>
                <?= $estate['desc'] ?>
            </p>
            <p class="fst-italic">
                <span class="fw-semibold">Location: </span>
                <?= $estate['location'] ?>
            </p>
            <p class="fst-italic">
                <span class="fw-semibold">Price: </span>

                <?= $estate['price'] ?>&euro; per night
            </p>
        </div>
        <div>
            <div id="dst" class="fw-light fst-italic"></div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline-warning">Make a Reservation</button>
            </div>
        </div>
    </div>
    <?php
    if ($avgRating > 0) {
        echo '<p class="card-text">' . number_format($avgRating, 1) . '</p>';
    }
    ?>
</section>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    var map = L.map('map').setView([<?= $estate['lat']; ?>, <?= $estate['long']; ?>], 9);
    var marker = L.marker([<?= $estate['lat']; ?>, <?= $estate['long']; ?>]).addTo(map);;

    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var userLat = position.coords.latitude;
            var userLong = position.coords.longitude;
            var userCoord = [userLat, userLong];

            var polyline = L.polyline([userCoord, [<?= $estate['lat']; ?>, <?= $estate['long']; ?>]], { color: 'red' }).addTo(map);

            var distance = haversineDistance(userLat, userLong, <?= $estate['lat']; ?>, <?= $estate['long']; ?>);
            var distanceElement = document.createElement('p');
            distanceElement.textContent = 'Distance to the estate: ' + distance.toFixed(2) + ' km';
            document.getElementById('dst').appendChild(distanceElement);
        });
    }
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    function haversineDistance(lat1, lon1, lat2, lon2) {
        const earthRadius = 6371; // Radius of the Earth in kilometers
        const dLat = (lat2 - lat1) * (Math.PI / 180);
        const dLon = (lon2 - lon1) * (Math.PI / 180);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1 * (Math.PI / 180)) * Math.cos(lat2 * (Math.PI / 180)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return earthRadius * c;
    }
</script>
<div class="fixed-bottom">
    <?php include 'includes/footer.php' ?>
</div>