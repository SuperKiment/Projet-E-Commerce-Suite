<?php

function homeController($twig, $db) {

    include_once("../src/model/ProductModel.php");
    include_once("../src/model/CategoryModel.php");

    echo $twig -> render('home.html.twig', [
        'products' => getAllProducts($db),
        'categories' => getAllCategories($db)
    ]);
}