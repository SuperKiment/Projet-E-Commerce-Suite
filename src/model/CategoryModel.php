<?php

function getOneCategory($db, $idCategory)
{
    $query = $db->prepare("SELECT id, label FROM categories WHERE id=:id");
    $query->execute([
        'id' => $idCategory
    ]);

    $category = $query->fetch();

    return $category;
}

function getAllCategories($db)
{
    $query = $db->prepare("SELECT id, label FROM categories");
    $query->execute([]);

    $category = $query->fetchAll();

    return $category;
}

function saveCategory($db, $label) {
    $query = $db -> prepare("INSERT INTO categories (label) VALUES (:label)");
    return $query -> execute([
        'label' => $label
    ]);
}