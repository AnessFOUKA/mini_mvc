<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Administrateur;

// Déclare la classe finale HomeController qui hérite de Controller
final class AdministrateurCtrl extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function getAllAdministrateurs()
    {
        $data=Administrateur::getAll();
        header("Content-Type:appplication/json");
        echo json_encode($data);
    }

    public function getAdministrateursFilteredById(){
        if(isset($_GET["id"])){
            $data=Administrateur::findByIdAdmin($_GET["id"]);
            header("Content-Type:application/json");
            echo json_encode($data); 
        }
    }

    public function createAdministrateur(){
        foreach(["nomUtilisateur", "email", "motDePasse", "superadmin"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $administrateur=new Administrateur();
        $administrateur->setNomUtilisateur($_POST["nomUtilisateur"]);
        $administrateur->setEmail($_POST["email"]);
        $administrateur->setMotDePasse($_POST["motDePasse"]);
        $administrateur->setSuperAdmin($_POST["superadmin"]);
        $administrateur->save();
    }

    public function updateAdministrateur(){
        foreach(["id","nomUtilisateur", "email", "motDePasse", "superadmin","id"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $administrateur=new Administrateur();
        $administrateur->setIdAdmin($_POST["id"]);
        $administrateur->setNomUtilisateur($_POST["nomUtilisateur"]);
        $administrateur->setEmail($_POST["email"]);
        $administrateur->setMotDePasse($_POST["motDePasse"]);
        $administrateur->setSuperAdmin($_POST["superadmin"]);
        $administrateur->update();
    }
    public function removeAdministrateur(){
        if(isset($_GET["id"])){
            $administrateur=new Administrateur();
            $administrateur->setIdAdmin($_GET["id"]);
            $administrateur->delete();
        }
    }
}