<!DOCTYPE html>
<html lang="en">

<?php
  include 'header.php';
?>

<body>

  <?php
    include 'config.php';

    include 'icons.svg';
    include 'navbar.php';
    include 'topMenu.php';
  ?>

  <!-- / products-carousel -->
  <!-- <section id="clothing" class="my-5 overflow-hidden">
    <div class="container pb-5">

      <div class="section-header d-md-flex justify-content-between align-items-center mb-3">
        <h2 class="display-3 fw-normal">Products</h2>
      </div>

      <div class="products-carousel swiper">

        <div class="swiper-wrapper">

          <?php
            if(isset($_GET['catId']))
              $i = $_GET['catId'];
            else
              $i = 0;

            getItems($i);
          ?>

        </div>
      </div>

    </div>
  </section> -->

  <!-- all products section -->
  <section id="foodies" class="my-5">
    <div class="container">

      <div class="section-header d-md-flex justify-content-between align-items-center">
        <h2 class="display-3 fw-normal">Products</h2>
      </div>

      <div class="isotope-container row">

        <?php
            if(isset($_GET['catId']))
              $i = $_GET['catId'];
            else
              $i = 0;

            getItems($i);
        ?>

      </div>


    </div>
  </section>

<?php include 'footer.php'; ?>


  <script src="js/jquery-1.11.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>