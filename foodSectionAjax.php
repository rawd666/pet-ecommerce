<?php
    include 'config.php';
    $cat1 = 1; 

    if(isset($_GET['catId2']))
        $cat2 = $_GET['catId2'];
    else
        $cat2 = 0;

    getFood($cat1, $cat2);
?>