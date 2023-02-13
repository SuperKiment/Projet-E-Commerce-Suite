<?php

function getConnection($config) {
    try {
        $pdo = new PDO('mysql:host='.$config['dbserver'].';dbname='.$config['dbname'], $config["dblogin"], $config['dbpassword']);
        $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $e) {
        //var_dump($e->getMessage());
        //die();
        $pdo = null;

        
    }

    return $pdo;
}