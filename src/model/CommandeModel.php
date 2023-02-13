<?php

function getOneCommande($db, $id)
{
    $query = $db->prepare("SELECT id, idUser, dateC, cloture FROM commande WHERE id=:id");
    $query->execute([
        'id' => $id
    ]);

    $comm = $query->fetch();

    return $comm;
}

function getAllCommandes($db)
{
    $query = $db->prepare("SELECT id, idUser, dateC, cloture FROM commande");
    $query->execute([]);

    $comm = $query->fetchAll();

    return $comm;
}

function saveCommande($db, $idUser)
{
    $query = $db->prepare("INSERT INTO commande (idUser, dateC) VALUES (:idUser, NOW())");
    return $query->execute([
        'idUser' => $idUser
    ]);
}

function updateOneCommande($db, $id, $idUser, $cloture)
{
    $query = $db->prepare("UPDATE commande 
                        SET idUser = :idUser, cloture = :cloture
                        WHERE id=:id");
    return $query->execute([
        'idUser' => $idUser,
        'cloture' => $cloture,
        'id' => $id
    ]);
}

function deleteOneCommande($db, $id)
{
    $query = $db->prepare("DELETE FROM commande WHERE id=:id");
    $query->execute([
        'id' => $id
    ]);
    if ($query->rowCount() > 0) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function PasserCommande($db, $paniers, $idUser)
{
    saveCommande($db, $idUser);

    $query = $db->prepare("SELECT id FROM commande ORDER BY id DESC");
    $query->execute([]);

    $idCommande = $query->fetch();

    foreach ($paniers as $panier) {
        saveProduitCommande($db, $panier['product'], $idCommande[0], $panier['quantity']);
    }
}

function saveProduitCommande($db, $product, $commande, $quantity)
{
    $query = $db->prepare("INSERT INTO productcommande (idProduct, idCommande, quantity) VALUES (:idProduit, :idCommande, :quantity)");
    return $query->execute([
        'idCommande' => $commande,
        'idProduit' => $product['id'],
        'quantity' => $quantity
    ]);
}
