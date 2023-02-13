<?php

function adminProductsController($twig, $db)
{
    include_once '../src/model/ProductModel.php';
    include_once '../src/model/CategoryModel.php';


    echo $twig->render('adminProducts.html.twig', [
        'products' => getAllProducts($db),
        'categories' => getAllCategories($db)
    ]);
}
