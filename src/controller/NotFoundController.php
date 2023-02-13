<?php

function notFoundController($twig) {
    echo $twig -> render('notFound.html.twig', []);
}