<?php

function showProductController($twig, $db)
{
    include_once '../src/model/ProductModel.php';

    $product = null;
    
    if (isset($_GET['product'])) {
        $product = getOneProduct($db, $_GET['product']);
    }
    echo $twig->render('showProduct.html.twig', [
        'product' => $product
    ]);
}
