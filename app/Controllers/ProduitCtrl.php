<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Produit;

// Déclare la classe finale HomeController qui hérite de Controller
final class ProduitCtrl extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function getAllProduit()
    {
        $data=Produit::getAll();
        header("Content-Type:appplication/json");
        echo json_encode($data);
    }

    public function getProduitFilteredById(){
        if(isset($_GET["id"])){
            $data=Produit::findByIdProduit($_GET["id"]);
            header("Content-Type:application/json");
            echo json_encode($data); 
        }
    }

    public function createProduit(){
        foreach(["nom", "description", "prix", "stock", "image","disponibilite","idCategorie"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $produit=new Produit();
        $produit->setNom($_POST["nom"]);
        $produit->setDescription($_POST["description"]);
        $produit->setPrix($_POST["prix"]);
        $produit->setStock($_POST["stock"]);
        $produit->setImage($_POST["image"]);
        $produit->setDisponibilite($_POST["disponibilite"]);
        $produit->setIdCategorie($_POST["idCategorie"]);
        $produit->save();
    }

    public function updateProduit(){
        foreach(["id","nom", "description", "prix", "stock", "image","disponibilite","idCategorie"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $produit=new Produit();
        $produit->setIdProduit($_POST["id"]);
        $produit->setNom($_POST["nom"]);
        $produit->setDescription($_POST["description"]);
        $produit->setPrix($_POST["prix"]);
        $produit->setStock($_POST["stock"]);
        $produit->setImage($_POST["image"]);
        $produit->setDisponibilite($_POST["disponibilite"]);
        $produit->setIdCategorie($_POST["idCategorie"]);
        $produit->update();
    }
    public function removeProduit(){
        if(isset($_GET["id"])){
            $produit=new Produit();
            $produit->setIdProduit($_GET["id"]);
            $produit->delete();
        }
    }
}