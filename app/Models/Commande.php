<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Commande
{
    private $idCommande;
    private $statut;
    private $montantTotal;
    private $adresse;
    private $ville;
    private $codePostal;
    private $idClient;

    // =====================
    // Getters / Setters
    // =====================

    public function getIdCommande()
    {
        return $this->idCommande;
    }

    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function getMontantTotal()
    {
        return $this->montantTotal;
    }

    public function setMontantTotal($montantTotal)
    {
        $this->montantTotal = $montantTotal;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    public function getIdClient()
    {
        return $this->idClient;
    }

    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM commande ORDER BY id_commande DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     * @param int $id
     * @return array|null
     */
    public static function findByIdCommande($idCommande)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM commande WHERE id_commande = ?");
        $stmt->execute([$idCommande]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO commande (statut, montant_total, adresse, ville, code_postal, id_client) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$this->statut, $this->montantTotal, $this->adresse, $this->ville, $this->codePostal, $this->idClient]);
    }

    /**
     * Met à jour les informations d’un utilisateur existant
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE commande SET statut = ?, montant_total= ?, adresse= ?, ville= ?, code_postal= ?, id_client=? WHERE id_commande = ?");
        return $stmt->execute([$this->statut,$this->montantTotal,$this->adresse,$this->ville,$this->codePostal,$this->idClient,$this->idCommande]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM commande WHERE id_commande = ?");
        return $stmt->execute([$this->idCommande]);
    }
}
