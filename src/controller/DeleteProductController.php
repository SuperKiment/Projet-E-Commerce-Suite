<?php

function deleteProductController($twig, $db)
{

    include_once '../src/model/ProductModel.php';

    $product = deleteOneProduct($db, $_GET['product']);

    if ($product) {
        $form = [
            'state' => 'success',
            'message' => 'L\'enregistrement ' . $_GET['product'] . ' a bien été supprimé !'
        ];
    } else {
        $form = [
            'state' => 'danger',
            'message' => 'L\'enregistrement ' . $_GET['product'] . ' n\'existe pas !'
        ];
    }
    echo $twig->render('message.html.twig', [
        'form' => $form
    ]);
}
