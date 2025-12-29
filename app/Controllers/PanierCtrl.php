<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Panier;

// Déclare la classe finale HomeController qui hérite de Controller
final class PanierCtrl extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function getAllPanier()
    {
        $data=Panier::getAll();
        header("Content-Type:appplication/json");
        echo json_encode($data);
    }

    public function getPanierFilteredById(){
        if(isset($_GET["id"])){
            $data=Panier::findByIdPanier($_GET["id"]);
            header("Content-Type:application/json");
            echo json_encode($data); 
        }
    }

    public function createPanier(){
        foreach(["idClient"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $panier=new Panier();
        $panier->setIdClient($_POST["idClient"]);
        $panier->save();
    }

    public function updatePanier(){
        foreach(["id","idClient"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $panier=new Panier();
        $panier->setIdPanier($_POST["id"]);
        $panier->setIdClient($_POST["idClient"]);
        $panier->update();
    }
    public function removePanier(){
        if(isset($_GET["id"])){
            $panier=new Panier();
            $panier->setIdPanier($_GET["id"]);
            $panier->delete();
        }
    }
}