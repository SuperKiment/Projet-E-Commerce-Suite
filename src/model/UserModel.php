<?php

function saveUser($db, $email, $password, $nom, $prenom, $idrole)
{
    $query = $db->prepare("INSERT INTO users (email, nom, prenom, idRole, `password`) 
                            VALUES (:email, :nom, :prenom, :idRole, :password)");
    return $query->execute([
        'email' => $email,
        'nom' => $nom,
        'prenom' => $prenom,
        'idRole' => $idrole,
        'password' => $password
    ]);
}


function getOneUserCredentials($db, $email)
{
    $query = $db->prepare("SELECT id, email, `password`, idRole FROM users WHERE email=:email");
    $query->execute([
        'email' => $email
    ]);

    $product = $query->fetch();

    return $product;
}

function getOneUser($db, $id)
{
    $query = $db->prepare("SELECT id, email, `password`, idRole, nom, prenom FROM users WHERE id=:id");
    $query->execute([
        'id' => $id
    ]);

    $user = $query->fetch();

    return $user;
}

function getAllUsers($db)
{
    $query = $db->prepare("SELECT id, nom, prenom, idRole, email FROM users");
    $query->execute([]);

    $users = $query->fetchAll();

    return $users;
}

function getAllRoles($db)
{
    $query = $db->prepare("SELECT id, label FROM role");
    $query->execute([]);

    $roles = $query->fetchAll();

    return $roles;
}

function updateOneUser($db, $id, $nom, $prenom, $email, $idrole)
{
    $query = $db->prepare("UPDATE users SET nom=:nom,
    prenom=:prenom, email=:email, idRole=:idRole WHERE id=:id");
    return $query->execute([
        'id' => $id,
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'idRole' => $idrole,
    ]);
}

function deleteOneUser($db, $id)
{
    $query = $db->prepare("DELETE FROM users WHERE id=:id");
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