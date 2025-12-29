<?php

// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Client;
use Mini\Models\Panier;
use Mini\Models\PanierContenu;
use Mini\Models\Produit;

// Déclare la classe finale HomeController qui hérite de Controller
final class ClientCtrl extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function getAllClients()
    {
        $data=Client::getAll();
        header("Content-Type:appplication/json");
        echo json_encode($data);
    }

    public function getClientsFilteredById(){
        if(isset($_GET["id"])){
            $data=Client::findByIdCategorie($_GET["id"]);
            header("Content-Type:application/json");
            echo json_encode($data); 
        }
    }

    public function createClient(){
        foreach(["adresse","ville","codePostal","email","motDePasse"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $client=new Client();
        $client->setAdresse($_POST["adresse"]);
        $client->setVille($_POST["ville"]);
        $client->setCodePostal($_POST["codePostal"]);
        $client->setEmail($_POST["email"]);
        $client->setMotDePasse($_POST["motDePasse"]);
        $client->save();
        $data=Client::getAll()[0];
        $panier=new Panier();
        $panier->setIdClient($data["id_client"]);
        $panier->save();
    }

    public function getClientPanier(){
        $paniers=Panier::getAll();
        $paniersContenu=PanierContenu::getAll();
        $produitsId=[];
        if(isset($_GET["id"])){
            foreach($paniers as $panier){
                if($panier["id_client"]==$_GET["id"]){
                    foreach($paniersContenu as $panierContenu){
                        if($panierContenu["id_panier"]==$panier["id_panier"]){
                            $produitsId[]=["panierContenu"=>$panierContenu,"infosProduit"=>Produit::findByIdProduit($panierContenu["id_produit"])];     
                        }
                    }
                }
            }
            header("Content-Type:application/json");
            echo json_encode($produitsId);
        }
    }

    public function updateClient(){
        foreach(["id","adresse","ville","codePostal","email","motDePasse","id"] as $field){
            if(!isset($_POST[$field])){
                header("Content-Type:application/json");
                echo json_encode([
                    "error"=>"uncorrect fields"
                ]);
                return NULL;
            }
        }
        $client=new Client();
        $client->setIdClient($_POST["id"]);
        $client->setAdresse($_POST["adresse"]);
        $client->setVille($_POST["ville"]);
        $client->setCodePostal($_POST["codePostal"]);
        $client->setEmail($_POST["email"]);
        $client->setMotDePasse($_POST["motDePasse"]);
        $client->update();
    }
    public function removeClient(){
        if(isset($_GET["id"])){
            $client=new Client();
            $client->setIdClient($_GET["id"]);
            $client->delete();
        }
    }
}