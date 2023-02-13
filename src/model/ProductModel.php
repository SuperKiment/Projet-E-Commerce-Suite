<?php

function getOneProduct($db, $idProduct)
{
    $query = $db->prepare("SELECT id, label, `description`, price, idCategory, `image` FROM product WHERE id=:id");
    $query->execute([
        'id' => $idProduct
    ]);

    $product = $query->fetch();

    return $product;
}

function getAllProducts($db)
{
    $query = $db->prepare("SELECT id, label, `description`, price, idCategory, `image` FROM product");
    $query->execute([]);

    $product = $query->fetchAll();

    return $product;
}

function saveProduct($db, $label, $description, $price, $category, $image)
{
    $query = $db->prepare("INSERT INTO product (label, `description`, price, idCategory, `image`) VALUES (:label, :descr, :price, :idCategory, :image)");
    return $query->execute([
        'label' => $label,
        'descr' => $description,
        'price' => $price,
        'idCategory' => $category,
        'image' => $image
    ]);
}

function updateOneProduct($db, $id, $label, $description, $price, $category)
{
    $query = $db->prepare("UPDATE product SET label=:label,
    `description`=:descr, price=:price, idCategory=:category WHERE id=:id");
    return $query->execute([
        'id' => $id,
        'label' => $label,
        'descr' => $description,
        'price' => $price,
        'category' => $category,
    ]);
}

function deleteOneProduct($db, $id)
{
    $query = $db->prepare("DELETE FROM product WHERE id=:id");
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
