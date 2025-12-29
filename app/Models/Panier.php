<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Panier
{
    private $idPanier;
    private $idClient;

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
        $stmt = $pdo->query("SELECT * FROM panier ORDER BY id_panier DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     * @param int $id
     * @return array|null
     */
    public static function findByIdPanier($idPanier)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM panier WHERE id_panier = ?");
        $stmt->execute([$idPanier]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO panier (id_client) VALUES (?)");
        return $stmt->execute([$this->idClient]);
    }

    /**
     * Met à jour les informations d’un utilisateur existant
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE panier SET id_client= ? WHERE id_panier = ?");
        return $stmt->execute([$this->idClient,$this->idPanier]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM panier WHERE id_panier = ?");
        return $stmt->execute([$this->idPanier]);
    }
}
