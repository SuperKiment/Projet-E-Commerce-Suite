<?php

function getOnePanierFromUser($db, $idUser)
{
    $query = $db->prepare("SELECT id, idUser, idProduct, quantity FROM panier WHERE idUser=:idUser");
    $query->execute([
        'idUser' => $idUser
    ]);

    $product = $query->fetchAll();

    return $product;
}

function savePanier($db, $idUser, $idProduct, $quantity)
{

    $isPanier = getOnePanierFromUser($db, $idUser);

    //Si il y a déjà des paniers pour ce user
    if ($isPanier != false) {

        //On regarde les paniers qui existent déjà et si il y en a 
        //déjà un avec le produit, on ajoute au produit la quantité
        foreach ($isPanier as $panier) {
            if ($panier['idProduct'] == $idProduct) {

                $newQuantity = $quantity + $panier['quantity'];
                return updateOnePanier($db, $idUser, $idProduct, $newQuantity);
            }
        }
        //Si le panier n'a pas été updated alors on crée le panier
    }


    $query = $db->prepare("INSERT INTO panier (idUser, idProduct, quantity) VALUES (:idUser, :idProduct, :quantity)");
    return $query->execute([
        'idUser' => $idUser,
        'idProduct' => $idProduct,
        'quantity' => $quantity,
    ]);
}


function updateOnePanier($db, $idUser, $idProduct, $quantity)
{
    $query = $db->prepare("UPDATE panier SET quantity=:quantity
                         WHERE idUser=:idUser and idProduct = :idProduct");
    return $query->execute([
        'idUser' => $idUser,
        'idProduct' => $idProduct,
        'quantity' => $quantity
    ]);
}

function deleteOnePanier($db, $idUser, $idProduct)
{
    $query = $db->prepare("DELETE FROM panier WHERE idProduct=:idProduct AND idUser=:idUser");
    $query->execute([
        'idProduct' => $idProduct,
        'idUser' => $idUser
    ]);
    if ($query->rowCount() > 0) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}