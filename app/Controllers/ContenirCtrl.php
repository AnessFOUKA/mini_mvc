<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Contenir;

// Déclare la classe finale HomeController qui hérite de Controller
final class ContenirCtrl extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function getAllContenir()
    {
        $data=Contenir::getAll();
        header("Content-Type:appplication/json");
        echo json_encode($data);
    }

    public function createContenir(){
        foreach(["idProduit", "idCommande", "quantite", "prixUnitaire", "sousTotal"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $contenir=new Contenir();
        $contenir->setIdProduit($_POST["idProduit"]);
        $contenir->setIdCommande($_POST["idCommande"]);
        $contenir->setQuantite($_POST["quantite"]);
        $contenir->setPrixUnitaire($_POST["prixUnitaire"]);
        $contenir->setSousTotal($_POST["sousTotal"]);
        $contenir->save();
    }
}