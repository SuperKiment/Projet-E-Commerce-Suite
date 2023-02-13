<?php

function showPanierController($twig, $db)
{
    include_once '../src/model/PanierModel.php';
    include_once '../src/model/ProductModel.php';

    if (isset($_GET['delProduct'])) {
        deleteOnePanier($db, $_SESSION['auth']['id'], $_GET['delProduct']);
    }

    $paniers = getOnePanierFromUser($db, $_SESSION['auth']['id']);
    $products = getAllProducts($db);
    var_dump($paniers);

    $i = 0;
    foreach ($paniers as $panier) {
        foreach ($products as $product) {
            if ($panier['idProduct'] == $product['id']) {
                $paniers[$i]['product'] = $product;
            }
        }
        $i++;
    }


    echo $twig->render('showPanier.html.twig', [
        'paniers' => $paniers,
    ]);
}
