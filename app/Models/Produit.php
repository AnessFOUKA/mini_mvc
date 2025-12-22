<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Produit
{
    private $idProduit;
    private $nom;
    private $description;
    private $prix;
    private $stock;
    private $image;
    private $disponibilite;
    private $idCategorie;

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

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getDisponibilite()
    {
        return $this->disponibilite;
    }

    public function setDisponibilite($disponibilite)
    {
        $this->disponibilite = $disponibilite;
    }

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM produit ORDER BY id_produit DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     * @param int $id
     * @return array|null
     */
    public static function findByIdProduit($idProduit)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM produit WHERE id_produit = ?");
        $stmt->execute([$idProduit]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO produit (nom,description,prix,stock,image,disponibilite,id_categorie) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$this->nom,$this->description,$this->prix,$this->stock,$this->image,$this->disponibilite,$this->idCategorie]);
    }

    /**
     * Met à jour les informations d’un utilisateur existant
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE produit SET nom = ?, description= ?, prix= ?, stock= ?, image= ?, disponibilite=?, id_categorie=? WHERE id_produit = ?");
        return $stmt->execute([$this->nom,$this->description,$this->prix,$this->stock,$this->image,$this->disponibilite,$this->idCategorie,$this->idProduit]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM produit WHERE id_produit = ?");
        return $stmt->execute([$this->idProduit]);
    }
}
