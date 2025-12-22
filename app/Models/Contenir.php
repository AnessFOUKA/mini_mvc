<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Contenir
{
    private $idProduit;
    private $idCommande;
    private $quantite;
    private $prixUnitaire;
    private $sousTotal;

    // =====================
    // Getters / Setters
    // =====================

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
    }

    public function getIdCommande()
    {
        return $this->idCommande;
    }

    public function setIdCommande($idCommande)
    {
        $this->idCommande = $idCommande;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    public function getPrixUnitaire()
    {
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire($prixUnitaire)
    {
        $this->prixUnitaire = $prixUnitaire;
    }

    public function getSousTotal()
    {
        return $this->sousTotal;
    }

    public function setSousTotal($sousTotal)
    {
        $this->sousTotal = $sousTotal;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM contenir");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO contenir (id_produit, id_commande, quantite, prix_unitaire, sous_total) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$this->idProduit,$this->idCommande,$this->quantite,$this->prixUnitaire,$this->sousTotal]);
    }
}
