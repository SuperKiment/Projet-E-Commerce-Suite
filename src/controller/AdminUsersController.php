<?php

function adminUsersController($twig, $db)
{
    include_once '../src/model/UserModel.php';


    echo $twig->render('adminUsers.html.twig', [
        'users' => getAllUsers($db),
        'roles' => getAllRoles($db)
    ]);
}
