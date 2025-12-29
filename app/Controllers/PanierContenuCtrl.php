<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\PanierContenu;

// Déclare la classe finale HomeController qui hérite de Controller
final class PanierContenuCtrl extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function getAllPanierContenu()
    {
        $data=PanierContenu::getAll();
        header("Content-Type:appplication/json");
        echo json_encode($data);
    }

    public function createPanierContenu(){
        foreach(["idProduit", "idPanier", "quantite", "prixUnitaire"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $panierContenu=new PanierContenu();
        $panierContenu->setIdProduit($_POST["idProduit"]);
        $panierContenu->setIdPanier($_POST["idPanier"]);
        $panierContenu->setQuantite($_POST["quantite"]);
        $panierContenu->setPrixUnitaire($_POST["prixUnitaire"]);
        $panierContenu->save();
    }

    public function updatePanierContenu(){
        foreach(["idProduit", "idPanier", "quantite", "prixUnitaire","currentIdPanier","currentIdProduit"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $panierContenu=new PanierContenu();
        $panierContenu->setCurrentIdProduit($_POST["currentIdProduit"]);
        $panierContenu->setCurrentIdPanier($_POST["currentIdPanier"]);
        $panierContenu->setIdProduit($_POST["idProduit"]);
        $panierContenu->setIdPanier($_POST["idPanier"]);
        $panierContenu->setQuantite($_POST["quantite"]);
        $panierContenu->setPrixUnitaire($_POST["prixUnitaire"]);
        $panierContenu->update();
    }

    public function removePanierContenu(){
        if(isset($_GET["currentIdProduit"]) && isset($_GET["currentIdPanier"])){
            $panierContenu=new PanierContenu();
            $panierContenu->setCurrentIdProduit($_GET["currentIdProduit"]);
            $panierContenu->setCurrentIdPanier($_GET["currentIdPanier"]);
            $panierContenu->delete();
        }
    }
}