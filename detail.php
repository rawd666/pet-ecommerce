<!DOCTYPE html>
<html lang="en">

<?php include 'header.php'; ?>

<body>

<?php
    include 'icons.svg';
    include 'navbar.php';
    include 'topMenu.php';
?>

<?php
$conn = mysqli_connect("localhost","root","","waggy");

if(isset($_GET['prodId'])) {
    $prodId = intval($_GET['prodId']);
    $q = "SELECT * FROM product WHERE prodId = $prodId";
    $result = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $prodName = $row['prodName'];
        $prodPrice = $row['prodPrice'];
        $prodDesc = $row['prodDesc'];
        $prodImage = $row['prodImage'];
    } else {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<div class="container my-5 py-5">
    <div class="row">
        <div class="col-md-5">
            <div class="card position-relative">
                <img src="<?php echo $prodImage; ?>" class="img-fluid rounded-4" alt="image">
            </div>
        </div>
        <div class="col-md-7">
            <h3 class="card-title pt-4 m-0"><?php echo $prodName; ?></h3>
            <h3 class="secondary-font text-primary">$<?php echo $prodPrice; ?></h3>
            <div class="card-text mb-4"><?php echo $prodDesc; ?></div>
            <form method="post" action="addToCart.php">
                <input type="hidden" name="prodId" value="<?php echo $prodId; ?>" />
                <input type="hidden" name="qty" value="1" />
                <button type="submit" class="btn-cart px-4 pt-3 pb-3">
                    <h5 class="text-uppercase m-0">Add to Cart</h5>
                </button>
            </form>
            <div class="d-flex pt-2">
                <span class="rating secondary-font">
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                    5.0
                </span>
            </div>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="#"><iconify-icon icon="ri:facebook-fill"></iconify-icon></a>
                    <a class="text-dark px-2" href="#"><iconify-icon icon="ri:twitter-fill"></iconify-icon></a>
                    <a class="text-dark px-2" href="#"><iconify-icon icon="ri:pinterest-fill"></iconify-icon></a>
                    <a class="text-dark px-2" href="#"><iconify-icon icon="ri:instagram-fill"></iconify-icon></a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script src="js/jquery-1.11.0.min.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>
</html>