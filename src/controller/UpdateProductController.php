<?php

use Twig\Node\Expression\Binary\LessBinary;

function updateProductController($twig, $db)
{
    include_once '../src/model/ProductModel.php';
    include_once '../src/model/CategoryModel.php';

    $form = [];

    if (isset($_GET['product'])) {

        $product = getOneProduct($db, $_GET['product']);

        if (isset($_POST['btnPostProduct'])) {
            $label = $_POST['productLabel'];
            $description = $_POST['productDescription'];
            $price = $_POST['productPrice'];
            if (empty($price)) {
                $price = 0.00;
            }
            $category = $_POST['productCategory'];
            if (!empty($label) && !empty($description) && !empty($category)) {
                updateOneProduct($db, $product['id'], $label, $description, $price, $category);
                $form['state'] = 'success';
                $form['message'] = 'Votre produit a bien été modifié !';
            } else {
                $form['state'] = 'danger';
                $form['message'] = 'Veuillez remplir tous les champs !';
            }
        }

        if ($product == null) {
            $form['state'] = 'non-existent';
            $form['message'] = 'Le produit n\'existe pas !';

            echo $twig->render('updateProduct.html.twig', [
                'form' => $form
            ]);
            return 0;
        }

        echo $twig->render('updateProduct.html.twig', [
            'product' => $product,
            'page' => '?page=updateProduct&product=' . $product['id'],
            'categories' => getAllCategories($db),
            'form' => $form
        ]);
    } else {

        $form['state'] = 'non-existent';
        $form['message'] = 'L\'identifiant de produit est erroné !';

        echo $twig->render('updateProduct.html.twig', [
            'form' => $form
        ]);
    }
}
