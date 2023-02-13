<?php

function adminCommandesController($twig, $db)
{
    include_once '../src/model/CommandeModel.php';
    include_once '../src/model/UserModel.php';

    if (isset($_GET['cloture'])) {
        updateOneCommande($db, $_GET['cloture'], $_GET['user'], 1);
    }

    if (isset($_GET['decloture'])) {
        updateOneCommande($db, $_GET['decloture'], $_GET['user'], 0);
    }

    echo $twig->render('adminCommandes.html.twig', [
        'commandes' => getAllCommandes($db),
        'users' => getAllUsers($db)
    ]);
}
