<div class="container">
      <nav class="main-menu d-flex navbar navbar-expand-lg ">

        <div class="d-flex d-lg-none align-items-end mt-3">
          <ul class="d-flex justify-content-end list-unstyled m-0">
            <li>
              <a href="account.html" class="mx-3">
                <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
              </a>
            </li>
            <li>
              <a href="wishlist.html" class="mx-3">
                <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
              </a>
            </li>

            <li>
              <a href="#" class="mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart"
                aria-controls="offcanvasCart">
                <iconify-icon icon="mdi:cart" class="fs-4 position-relative"></iconify-icon>
                <span class="position-absolute translate-middle badge rounded-circle bg-primary pt-2">
                  03
                </span>
              </a>
            </li>

            <li>
              <a href="#" class="mx-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch"
                aria-controls="offcanvasSearch">
                <iconify-icon icon="tabler:search" class="fs-4"></iconify-icon>
                </span>
              </a>
            </li>
          </ul>

        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

          <div class="offcanvas-header justify-content-center">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body justify-content-between">
            <select id="categoryDropdown" class="filter-categories border-0 mb-0 me-5">
              <option>Shop by Category</option>

              <?php
                include_once('config.php');
                getCategories();
                
              ?>

            </select>

            <ul class="navbar-nav menu-list list-unstyled d-flex gap-md-3 mb-0">
              <li class="nav-item">
                <a href="index.php" class="nav-link active">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown"
                  aria-expanded="false">Pages</a>
                <ul class="dropdown-menu" aria-labelledby="pages">
                  <li><a href="index.php" class="dropdown-item">About Us</a></li>
                  <li><a href="index.php" class="dropdown-item">Shop</a></li>
                  <li><a href="index.php" class="dropdown-item">Single Product</a></li>
                  <li><a href="index.php" class="dropdown-item">Cart</a></li>
                  <li><a href="index.php" class="dropdown-item">Wishlist</a></li>
                  <li><a href="index.php" class="dropdown-item">Checkout</a></li>
                  <li><a href="index.php" class="dropdown-item">Blog</a></li>
                  <li><a href="index.php" class="dropdown-item">Single Post</a></li>
                  <li><a href="index.php" class="dropdown-item">Contact</a></li>
                  <li><a href="index.php" class="dropdown-item">FAQs</a></li>
                  <li><a href="index.php" class="dropdown-item">Account</a></li>
                  <li><a href="index.php" class="dropdown-item">Thankyou</a></li>
                  <li><a href="index.php" class="dropdown-item">Error 404</a></li>
                  <li><a href="index.php" class="dropdown-item">Styles</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="index.php" class="nav-link">Shop</a>
              </li>
              <li class="nav-item">
                <a href="index.php" class="nav-link">Blog</a>
              </li>
              <li class="nav-item">
                <a href="index.php" class="nav-link">Contact</a>
              </li>
              <li class="nav-item">
                <a href="index.php" class="nav-link">Others</a>
              </li>
            </ul>

            <div class="d-none d-lg-flex align-items-end">
              <ul class="d-flex justify-content-end list-unstyled m-0">
                <li>
                  <a href="login.php" class="mx-3">
                    <iconify-icon icon="healthicons:person" class="fs-4"></iconify-icon>
                  </a>
                </li>
                <li>
                  <a href="index.php" class="mx-3">
                    <iconify-icon icon="mdi:heart" class="fs-4"></iconify-icon>
                  </a>
                </li>

                <li>
                  <a href="cart.php" class="mx-3">
                    <iconify-icon icon="mdi:cart" class="fs-4 position-relative"></iconify-icon>
                    <!--<span class="position-absolute translate-middle badge rounded-circle bg-primary pt-2">
                      03
                    </span>-->
                  </a>
                </li>
              </ul>

            </div>

          </div>

        </div>

      </nav>

    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdown = document.getElementById("categoryDropdown");
        dropdown.addEventListener("change", function () {
            const url = this.value;
            if (url) {
                window.location.href = url;
            }
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