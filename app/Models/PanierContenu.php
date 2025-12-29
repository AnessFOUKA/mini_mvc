<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class PanierContenu
{
    private $idPanier;
    private $idProduit;
    private $quantite;
    private $prixUnitaire;
    private $currentIdPanier;
    private $currentIdProduit;

    // =====================
    // Getters / Setters
    // =====================

    public function getIdPanier()
    {
        return $this->idPanier;
    }

    public function setIdPanier($idPanier)
    {
        $this->idPanier = $idPanier;
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setIdProduit($idProduit)
    {
        $this->idProduit = $idProduit;
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

    public function getCurrentIdPanier()
    {
        return $this->currentIdPanier;
    }

    public function setCurrentIdPanier($currentIdPanier)
    {
        $this->currentIdPanier = $currentIdPanier;
    }

    public function getCurrentIdProduit()
    {
        return $this->currentIdProduit;
    }

    public function setCurrentIdProduit($currentIdProduit)
    {
        $this->currentIdProduit = $currentIdProduit;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM panier_contenu");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO panier_contenu (id_produit, id_panier, quantite, prix_unitaire) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$this->idProduit,$this->idPanier,$this->quantite,$this->prixUnitaire]);
    }

    public function update()
    {
        echo json_encode([$this->idPanier,$this->idProduit,$this->quantite,$this->prixUnitaire,$this->currentIdProduit,$this->currentIdPanier]);
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE panier_contenu SET id_panier= ?, id_produit=?, quantite=?, prix_unitaire=? WHERE id_produit = ? and id_panier = ?");
        return $stmt->execute([$this->idPanier,$this->idProduit,$this->quantite,$this->prixUnitaire,$this->currentIdProduit,$this->currentIdPanier]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM panier_contenu WHERE id_panier= ? and id_produit=?");
        return $stmt->execute([$this->currentIdPanier,$this->currentIdProduit]);
    }
}
