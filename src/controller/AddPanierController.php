<?php

function addPanierController($twig, $db)
{
    include_once '../src/model/PanierModel.php';

    $form = [];
    if (isset($_GET['product']) && isset($_POST['addPanierQuant'])) {
        if (isset($_SESSION['auth'])) {
            $product = $_GET['product'];

            savePanier($db, $_SESSION['auth']['id'], $product, $_POST['addPanierQuant']);

            $form = [
                'state' => 'success',
                'message' => 'Votre produit a bien été ajouté au panier !'
            ];
        } else {
            $form = [
                'state' => 'danger',
                'message' => 'il faut être connecté pour ajouter un article au panier !'
            ];
        }
    } else {
        $form = [
            'state' => 'danger',
            'message' => 'Pas de produit ou de quantité spécifié !'
        ];
    }


    echo $twig->render('message.html.twig', [
        'form' => $form
    ]);
}
