<?php
function initTwig($path)
{
    $loader = new \Twig\Loader\FilesystemLoader($path);
    $twig = new \Twig\Environment($loader, []);
    $twig->addGlobal('session', $_SESSION);
    return $twig;
}
