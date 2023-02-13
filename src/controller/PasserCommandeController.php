<?php

function passerCommandeController($twig, $db)
{
    include_once '../src/model/CommandeModel.php';
    include_once '../src/model/PanierModel.php';
    include_once '../src/model/ProductModel.php';

    var_dump($_POST);

    $paniers = getOnePanierFromUser($db, $_SESSION['auth']['id']);
    $products = getAllProducts($db);

    $i = 0;
    foreach ($paniers as $panier) {
        foreach ($products as $product) {
            if ($panier['idProduct'] == $product['id']) {
                $paniers[$i]['product'] = $product;
            }
        }
        $i++;
    }

    PasserCommande($db, $paniers, $_SESSION['auth']['id']);

    echo $twig->render('message.html.twig', []);
}
