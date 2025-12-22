<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Categorie
{
    private $idCategorie;
    private $nom;
    private $description;
    private $image;

    // =====================
    // Getters / Setters
    // =====================

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }

    public function setIdCategorie($idCategorie)
    {
        $this->idCategorie = $idCategorie;
    }

    public function getnom()
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

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM categorie ORDER BY id_categorie DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     * @param int $id
     * @return array|null
     */
    public static function findByIdCategorie($id_categorie)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM categorie WHERE id_categorie = ?");
        $stmt->execute([$id_categorie]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO categorie (nom, description, image) VALUES (?, ?, ?)");
        return $stmt->execute([$this->nom, $this->description,$this->image]);
    }

    /**
     * Met à jour les informations d’un utilisateur existant
     * @return bool
     */
    public function update()
    {
        echo $this->idCategorie;
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE categorie SET nom = ?, description = ?, image= ? WHERE id_categorie = ?");
        return $stmt->execute([$this->nom, $this->description,$this->image, $this->idCategorie]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM categorie WHERE id_categorie = ?");
        return $stmt->execute([$this->idCategorie]);
    }
}
