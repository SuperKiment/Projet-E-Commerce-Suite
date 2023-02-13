<?php

function addCategoryController($twig, $db)
{
    include_once '../src/model/CategoryModel.php';

    $form = [];

    if (isset($_POST['btnAddCategory'])) {
        $label = htmlspecialchars($_POST['categoryLabel']);

        if (!empty($label)) {
            $form = [
                'state' => 'success',
                'message' => 'Votre produit a bien été ajouté !'
            ];

            saveCategory($db, $label);
        } else {

            $form = [
                'state' => 'danger',
                'message' => 'Votre catégorie n\'a pas été ajouté car les champs obligatoires
        n\'ont pas été remplis !'
            ];
        }
    }

    echo $twig->render('addCategory.html.twig', [
        'form' => $form
    ]);
}
