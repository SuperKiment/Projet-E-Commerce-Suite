<?php

$routes = [
    'home' => 'homeController:0',
    'about' => 'aboutController:0',
    'contact' => 'contactController:0',
    'mentionsLegales' => 'mentionsLegalesController:0',
    'notFound' => 'notFoundController:0',
    'dbError' => 'dbErrorController:0',

    'addProduct' => 'addProductController:2',
    'updateProduct' => 'updateProductController:2',
    'deleteProduct' => 'deleteProductController:2',
    'showProduct' => 'showProductController:1',
    'adminProducts' => 'adminProductsController:2',

    'addPanier' => 'addPanierController:0',
    'showPanier' => 'showPanierController:1',
    'passerCommande' => 'passerCommandeController:1',
    'adminCommandes' => 'adminCommandesController:2',

    'addUser' => 'addUserController:2',
    'deleteUser' => 'deleteUserController:2',
    'showUser' => 'showUserController:2',
    'adminUsers' => 'adminUsersController:2',

    'adminProductCategories' => 'adminProductCategoriesController:2',
    'addCategory' => 'addCategoryController:2',

    'login' => 'loginController:0',
    'register' => 'registerController:0',
    'logout' => 'logoutController:0',
];
