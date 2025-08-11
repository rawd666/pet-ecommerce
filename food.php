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

  <section id="foodies" class="my-5">
    <div class="container my-5 py-5" style="height: 1200px;">

      <div class="section-header d-md-flex justify-content-between align-items-center">
        <h2 class="display-3 fw-normal">Pet Foodies</h2>
        <div class="mb-4 mb-md-0">
          <p class="m-0">
            <button class="filter-button me-4  active" data-cat2="0">ALL</button>
            <button class="filter-button me-4 " data-cat2="5">CAT</button>
            <button class="filter-button me-4 " data-cat2="3">DOG</button>
            <button class="filter-button me-4 " data-cat2="2">BIRD</button>
          </p>
        </div>
      </div>

      <div id="food-products" class="isotope-container row">

        <?php getFood(1, 0); ?>

      </div>


    </div>
  </section>

<?php include 'footer.php'; ?>

<script>
  document.querySelectorAll('.filter-button').forEach(function(btn) {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.filter-button').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      let cat2 = btn.getAttribute('data-cat2');
      fetch('foodSectionAjax.php?catId2=' + cat2)
        .then(response => response.text())
        .then(html => {
          document.getElementById('food-products').innerHTML = html;
        });
    });
  });
  </script>  

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