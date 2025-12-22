<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Commande;

// Déclare la classe finale HomeController qui hérite de Controller
final class CommandeCtrl extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function getAllCommandes()
    {
        $data=Commande::getAll();
        header("Content-Type:appplication/json");
        echo json_encode($data);
    }

    public function getCommandesFilteredById(){
        if(isset($_GET["id"])){
            $data=Commande::findByIdCommande($_GET["id"]);
            header("Content-Type:application/json");
            echo json_encode($data); 
        }
    }

    public function createCommande(){
        foreach(["statut", "montantTotal", "adresse", "ville", "codePostal","idClient"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $commande=new Commande();
        $commande->setStatut($_POST["statut"]);
        $commande->setMontantTotal($_POST["montantTotal"]);
        $commande->setAdresse($_POST["adresse"]);
        $commande->setVille($_POST["ville"]);
        $commande->setCodePostal($_POST["codePostal"]);
        $commande->setIdClient($_POST["idClient"]);
        $commande->save();
    }

    public function updateCommande(){
        foreach(["id","statut", "montantTotal", "adresse", "ville", "codePostal","idClient"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $commande=new Commande();
        $commande->setIdCommande($_POST["id"]);
        $commande->setStatut($_POST["statut"]);
        $commande->setMontantTotal($_POST["montantTotal"]);
        $commande->setAdresse($_POST["adresse"]);
        $commande->setVille($_POST["ville"]);
        $commande->setCodePostal($_POST["codePostal"]);
        $commande->setIdClient($_POST["idClient"]);
        $commande->update();
    }
    public function removeCommande(){
        if(isset($_GET["id"])){
            $commande=new Commande();
            $commande->setIdCommande($_GET["id"]);
            $commande->delete();
        }
    }
}