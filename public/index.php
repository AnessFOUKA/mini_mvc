<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type");


use Mini\Core\Router;

//findByIdPanier
// Table des routes minimaliste
$routes = [
    ['GET', '/categories', [Mini\Controllers\CategorieCtrl::class, 'getAllCategories']],
    ['GET', '/client', [Mini\Controllers\ClientCtrl::class, 'getAllClients']],
    ['GET', '/administrateurs', [Mini\Controllers\AdministrateurCtrl::class, 'getAllAdministrateurs']],
    ['GET', '/commandes', [Mini\Controllers\CommandeCtrl::class, 'getAllCommandes']],
    ['GET', '/contenir', [Mini\Controllers\ContenirCtrl::class, 'getAllContenir']],
    ['GET', '/produit', [Mini\Controllers\ProduitCtrl::class, 'getAllProduit']],
    ['GET', '/panierContenu', [Mini\Controllers\PanierContenuCtrl::class, 'getAllPanierContenu']],
    ['GET', '/panier', [Mini\Controllers\PanierCtrl::class, 'getAllPanier']],
    ['GET', '/client/getClientPanier', [Mini\Controllers\ClientCtrl::class, 'getClientPanier']],
    ['GET', '/client/getClientCommands', [Mini\Controllers\ClientCtrl::class, 'getClientCommands']],
    
    ['GET', '/categories/filterById', [Mini\Controllers\CategorieCtrl::class, 'getCategoriesFilteredById']],
    ['GET', '/client/filterById', [Mini\Controllers\ClientCtrl::class, 'getClientsFilteredById']],
    ['GET', '/administrateurs/filterById', [Mini\Controllers\AdministrateurCtrl::class, 'getAdministrateursFilteredById']],
    ['GET', '/commandes/getCommandesFilteredById', [Mini\Controllers\CommandeCtrl::class, 'getCommandesFilteredById']],
    ['GET', '/produit/getProduitFilteredById', [Mini\Controllers\ProduitCtrl::class, 'getProduitFilteredById']],
    ['GET', '/panier/getPanierFilteredById', [Mini\Controllers\PanierCtrl::class, 'getPanierFilteredById']],
    
    ['POST', '/categories/createCategory', [Mini\Controllers\CategorieCtrl::class, 'createCategory']],
    ['POST', '/client/createClient', [Mini\Controllers\ClientCtrl::class, 'createClient']],
    ['POST', '/client/addToClientPanier', [Mini\Controllers\ClientCtrl::class, 'addToClientPanier']],
    ['POST', '/administrateurs/createAdministrateur', [Mini\Controllers\AdministrateurCtrl::class, 'createAdministrateur']],
    ['POST', '/commandes/createCommande', [Mini\Controllers\CommandeCtrl::class, 'createCommande']],
    ['POST', '/contenir/createContenir', [Mini\Controllers\ContenirCtrl::class, 'createContenir']],
    ['POST', '/produit/createProduit', [Mini\Controllers\ProduitCtrl::class, 'createProduit']],
    ['POST', '/panierContenu/createPanierContenu', [Mini\Controllers\PanierContenuCtrl::class, 'createPanierContenu']],
    ['POST', '/panier/createPanier', [Mini\Controllers\PanierCtrl::class, 'createPanier']],
//addToClientPanier()

    ['POST', '/categories/updateCategory', [Mini\Controllers\CategorieCtrl::class, 'updateCategory']],
    ['POST', '/client/updateClient', [Mini\Controllers\ClientCtrl::class, 'updateClient']],
    ['POST', '/administrateurs/updateAdministrateur', [Mini\Controllers\AdministrateurCtrl::class, 'updateAdministrateur']],
    ['POST', '/commandes/updateCommande', [Mini\Controllers\CommandeCtrl::class, 'updateCommande']],
    ['POST', '/produit/updateProduit', [Mini\Controllers\ProduitCtrl::class, 'updateProduit']],
    ['POST', '/panier/updatePanier', [Mini\Controllers\PanierCtrl::class, 'updatePanier']],
    ['POST', '/panierContenu/updatePanierContenu', [Mini\Controllers\PanierContenuCtrl::class, 'updatePanierContenu']],

    ['GET', '/categories/removeCategory', [Mini\Controllers\CategorieCtrl::class, 'removeCategory']],
    ['GET', '/client/removeClient', [Mini\Controllers\ClientCtrl::class, 'removeClient']],
    ['GET', '/administrateurs/removeAdministrateur', [Mini\Controllers\AdministrateurCtrl::class, 'removeAdministrateur']],
    ['GET', '/commandes/removeCommande', [Mini\Controllers\CommandeCtrl::class, 'removeCommande']],
    ['GET', '/produit/removeProduit', [Mini\Controllers\ProduitCtrl::class, 'removeProduit']],
    ['GET', '/panier/removePanier', [Mini\Controllers\PanierCtrl::class, 'removePanier']],
    ['GET', '/panierContenu/removePanierContenu', [Mini\Controllers\PanierContenuCtrl::class, 'removePanierContenu']]
];

// Bootstrap du router
if($_SERVER['REQUEST_METHOD']==="OPTIONS"){
    http_response_code(200);
}else{
    $router = new Router($routes);
    $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
}

