<?php

function adminProductCategoriesController($twig, $db)
{
    include_once '../src/model/ProductModel.php';

    var_dump($_POST);

    echo $twig->render('adminProductCategories.html.twig', []);
}
