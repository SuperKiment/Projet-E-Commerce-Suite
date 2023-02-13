<?php

function loginController($twig, $db)
{
    include_once '../src/model/UserModel.php';

    $form = [];

    if (isset($_SESSION['auth'])) {
        echo $twig->render('home.html.twig', [
            'form' => $form
        ]);

        return 0;
    }

    if (isset($_POST['submitLogin'])) {
        if (
            isset($_POST['email']) &&
            isset($_POST['password']) &&
            $_POST['email'] != "" &&
            $_POST['password'] != ""
        ) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = getOneUserCredentials($db, $email);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['auth']['login'] = $user['email'];
                    $_SESSION['auth']['role'] = $user['idRole'];
                    $form = [
                        'state' => 'success',
                        'message' => "Connexion réussie !"
                    ];
                } else {
                    $form = [
                        'state' => 'danger',
                        'message' => "Vos informations de connexion sont incorrects !"
                    ];
                }
            } else {
                $form = [
                    'state' => 'danger',
                    'message' => "L'un de vos identifiants est incorrect !"
                ];
            }
        }
    }
    echo $twig->render('login.html.twig', [
        'form' => $form
    ]);
}
