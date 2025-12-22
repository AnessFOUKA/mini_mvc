<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Categorie;

// Déclare la classe finale HomeController qui hérite de Controller
final class CategorieCtrl extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function getAllCategories()
    {
        $data=Categorie::getAll();
        header("Content-Type:appplication/json");
        echo json_encode($data);
    }

    public function getCategoriesFilteredById(){
        if(isset($_GET["id"])){
            $data=Categorie::findByIdCategorie($_GET["id"]);
            header("Content-Type:application/json");
            echo json_encode($data); 
        }
    }

    public function createCategory(){
        foreach(["nom","description","image"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $categorie=new Categorie();
        $categorie->setNom($_POST["nom"]);
        $categorie->setDescription($_POST["description"]);
        $categorie->setImage($_POST["image"]);
        $categorie->save();
    }

    public function updateCategory(){
        $categorie=new Categorie();
        foreach(["id","nom","description","image","id"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $categorie->setIdCategorie($_POST["id"]);
        $categorie->setNom($_POST["nom"]);
        $categorie->setDescription($_POST["description"]);
        $categorie->setImage($_POST["image"]);
        $categorie->update();
    }
    public function removeCategory(){
        if(isset($_GET["id"])){
            $categorie=new Categorie();
            $categorie->setIdCategorie($_GET["id"]);
            $categorie->delete();
        }
    }
}