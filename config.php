<?php
    define('Server',"localhost");
    define('user',"root");
    define('password',"");
    define('DB',"waggy");

    $conn = mysqli_connect(Server,user,password,DB);

    function getFood($cat1, $cat2) {
        global $conn;
        $items = "";

        if($cat1 != 0 && $cat2 != 0)
            $q = "select * from product p
            join product_categories pc on p.prodId = pc.prodId
            where pc.catId in ($cat1, $cat2)
            group by p.prodId
            having count(DISTINCT pc.catId) = 2
            LIMIT 8";
        else
            $q = "select * from product p
            join product_categories pc on p.prodId = pc.prodId
            where pc.catId = 1
            LIMIT 8";

        $result = mysqli_query($conn, $q);

        while($row = mysqli_fetch_assoc($result)){

            $prodName = $row['prodName'];
            $prodPrice = $row['prodPrice'];
            $prodDesc = $row['prodDesc'];
            $prodImage = $row['prodImage'];
            $prodId = $row['prodId'];

            $items .= <<<DELIMITER
                
                <div class="item cat col-md-4 col-lg-3 my-4">
                    <div class="card position-relative">
                        <a href="detail.php?prodId=$prodId"><img src="$prodImage" class="img-fluid rounded-4" alt="image"></a>
                        <div class="card-body p-0">
                            <a href="single-product.html">
                                <h3 class="card-title pt-4 m-0">$prodName</h3>
                            </a>

                            <div class="card-text">
                                <span class="rating secondary-font">
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                                5.0</span>

                                <h3 class="secondary-font text-primary">\$$prodPrice</h3>
                                <input type="hidden" name="prodId" value="$prodId" />
                                <input type="hidden" name="qty" value="1" />

                                <div class="d-flex flex-wrap mt-3">
                                    <form method="post" action="addToCart.php" style="display:inline;">
                                        <input type="hidden" name="prodId" value="$prodId">
                                        <input type="hidden" name="qty" value="1">

                                        <button type="submit" class="btn-cart me-3 px-4 pt-3 pb-3" style="border:1px;border-color:#666;cursor:pointer;">
                                            <h5 class="text-uppercase m-0">Add to Cart</h5>
                                        </button>
                                    </form>
                                    <a href="#" class="btn-wishlist px-4 pt-3 ">
                                        <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                                    </a>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            DELIMITER;
        }
        echo $items;
    }

    function getItems($id) {
        global $conn;
        $items = "";

        if($id != 0)
            $q = "select * from product
            join product_categories on product.prodId = product_categories.prodId
            where product_categories.catId = $id 
            LIMIT 8";
        else
            $q = "select * from product LIMIT 8";

        $result = mysqli_query($conn, $q);
        while($row = mysqli_fetch_assoc($result)){

            $prodName = $row['prodName'];
            $prodPrice = $row['prodPrice'];
            $prodDesc = $row['prodDesc'];
            $prodImage = $row['prodImage'];
            $prodId = $row['prodId'];

            $items .= <<<DELIMITER

            <div class="item cat col-md-4 col-lg-3 my-4">
                <div class="card position-relative">
                    <a href="detail.php?prodId=$prodId"><img src="$prodImage" class="img-fluid rounded-4 product-img" alt="image" style="height:'300'; width:'300'; object-fit:cover;"></a>
                    <div class="card-body p-0">
                    <a href="single-product.html">
                        <h3 class="card-title pt-4 m-0">$prodName</h3>
                    </a>

                    <div class="card-text">
                        <span class="rating secondary-font">
                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                        <iconify-icon icon="clarity:star-solid" class="text-primary"></iconify-icon>
                        5.0</span>

                        <h3 class="secondary-font text-primary">\$$prodPrice</h3>

                        <div class="d-flex flex-wrap mt-3">
                        <form method="post" action="addToCart.php" style="display:inline;">
                            <input type="hidden" name="prodId" value="$prodId">
                            <input type="hidden" name="qty" value="1">

                            <button type="submit" class="btn-cart me-3 px-4 pt-3 pb-3" style="border:1px;border-color:#666;cursor:pointer;">
                                <h5 class="text-uppercase m-0">Add to Cart</h5>
                            </button>
                        </form>
                        <a href="#" class="btn-wishlist px-4 pt-3 ">
                            <iconify-icon icon="fluent:heart-28-filled" class="fs-5"></iconify-icon>
                        </a>
                        </div>


                    </div>

                    </div>
                </div>
            </div>
            DELIMITER;
        }
        echo $items;
    }

    function getCategories(){
        global $conn;
        $q = "select * from category";
        $result = mysqli_query($conn, $q);
        $catMenu = "";

        while($row=mysqli_fetch_assoc($result)){

            $catId = $row['catId'];
            $catName = $row['catName'];

            $catMenu .= <<<DELIMITER
            <option value="category.php?catId=$catId">$catName</option>
            DELIMITER;

        }
        echo $catMenu;
    }

    
?>