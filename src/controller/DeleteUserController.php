<?php

function deleteUserController($twig, $db)
{

    include_once '../src/model/UserModel.php';

    $user = deleteOneUser($db, $_GET['user']);

    if ($user) {
        $form = [
            'state' => 'success',
            'message' => 'L\'enregistrement ' . $_GET['user'] . ' a bien été supprimé !'
        ];
    } else {
        $form = [
            'state' => 'danger',
            'message' => 'L\'enregistrement ' . $_GET['user'] . ' n\'existe pas !'
        ];
    }
    echo $twig->render('message.html.twig', [
        'form' => $form
    ]);
}
