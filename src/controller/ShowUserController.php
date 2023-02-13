<?php

function showUserController($twig, $db)
{
    include_once '../src/model/UserModel.php';

    $user = null;

    if (isset($_POST['modSubmit'])) {

        if ($_POST['modPass'] == $_POST['modPassVerif']) {
            $password = $_POST['modPass'];
            $user = getOneUserCredentials($db, $_SESSION['auth']['login']);

            if (password_verify($password, $user['password'])) {

                updateOneUser(
                    $db,
                    $_GET['user'],
                    $_POST['modNom'],
                    $_POST['modPrenom'],
                    $_POST['modEmail'],
                    $_POST['modRole']
                );
            }
        }
    }

    if (isset($_GET['user'])) {
        $user = getOneUser($db, $_GET['user']);
    }

    echo $twig->render('showUser.html.twig', [
        'user' => $user,
        'roles' => getAllRoles($db)
    ]);
}
