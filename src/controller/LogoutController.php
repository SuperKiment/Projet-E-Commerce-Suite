<?php

function logoutController($twig, $db)
{
    $_SESSION = [];
    session_destroy();
    echo $twig->render('home.html.twig', []);
}
