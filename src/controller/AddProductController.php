<?php

function addProductController($twig, $db)
{
    include_once '../src/model/ProductModel.php';
    include_once '../src/model/CategoryModel.php';

    $form = [];

    if (isset($_POST['btnPostProduct'])) {
        $label = htmlspecialchars($_POST['productLabel']);
        $description = htmlspecialchars($_POST['productDescription']);
        $price = htmlspecialchars($_POST['productPrice']);

        if (empty($price)) {
            $price = 0.00;
        }

        $category = htmlspecialchars($_POST['productCategory']);

        $file_name = null;

        if (isset($_FILES["productImage"])) {
            if (!empty($_FILES["productImage"]['name'])) {

                include_once "../src/service/Upload.php";

                $uploads = [
                    'extensions' => ['png', 'jpg'],
                    'path' => 'uploads/',
                    'state' => false
                ];
                // Tu dois mettre la fonction demandée du coup mdrr
                $verify = VerifyImageName($_FILES["productImage"], $uploads);
                $file_name = '';
                $msg = '';
                if ($verify['state']) {
                    $file_name = $verify['file'];
                } else $msg = $verify['msg'];

                $uploads['state'] = $verify['state'];

                /*
                $file_upload = explode(".", $_FILES["productImage"]['name']);
                // Vérification de l'extension
                if (in_array($file_upload[count($file_upload) - 1], $uploads['extensions'])) {
                    // Nettoyage des accents
                    $file_name = strtr(
                        $file_upload[0],
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
                    );
                    // Nettoyage des caractères spéciaux
                    $file_name = preg_replace('/([^.a-z0-9]+)/i', '_', $file_name);
                    $file_name = $file_name . '.' . $file_upload[count($file_upload) - 1];
                    $file_path = $uploads['path'] . $file_name;
                    if (!file_exists($file_path)) {
                        // Déplacement du fichier
                        move_uploaded_file($_FILES['productImage']['tmp_name'], $file_path);
                        $uploads['state'] = true;
                    } else {
                        $msg = "Une image avec ce nom existe déjà !";
                    }
                } else {
                    $msg = "L'extension du fichier n'est pas acceptée !";
                }
                */
            } else {
                $msg = "Veuillez choisir un fichier !";
            }
        }

        if (!empty($label) && !empty($description) && !empty($category)) {
            if ($uploads['state']) {
                $form = [
                    'state' => 'success',
                    'message' => 'Votre produit a bien été ajouté !'
                ];
            } else {
                $form = [
                    'state' => 'danger',
                    'message' => $msg
                ];
            }

            saveProduct($db, $label, $description, $price, $category, $file_name);
        } else {

            $form = [
                'state' => 'danger',
                'message' => 'Votre produit n\'a pas été ajouté car les champs obligatoires
        n\'ont pas été remplis !'
            ];
        }
    }

    echo $twig->render('addProduct.html.twig', [
        'form' => $form,
        'categories' => getAllCategories($db),
        'page' => '?page=addProduct'
    ]);
}
