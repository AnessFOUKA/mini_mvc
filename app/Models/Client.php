<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Client
{
    private $idClient;
    private $adresse;
    private $ville;
    private $codePostal;
    private $email;
    private $motDePasse;
    private $username;

    // =====================
    // Getters / Setters
    // =====================

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getIdClient()
    {
        return $this->idClient;
    }

    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;
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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM client ORDER BY id_client DESC");
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
        $stmt = $pdo->prepare("SELECT * FROM client WHERE id_client = ?");
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
        $stmt = $pdo->prepare("INSERT INTO client (username,adresse,ville,code_postal,email,mot_de_passe) VALUES (?,?, ?, ?, ?, ?)");
        return $stmt->execute([$this->username,$this->adresse, $this->ville,$this->codePostal,$this->email,$this->motDePasse]);
    }

    /**
     * Met à jour les informations d’un utilisateur existant
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE client SET username = ? adresse = ?, ville = ?, code_postal= ?, email= ?, mot_de_passe= ? WHERE id_client = ?");
        return $stmt->execute([$this->username,$this->adresse, $this->ville,$this->codePostal,$this->email,$this->motDePasse, $this->idClient]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM client WHERE id_client = ?");
        return $stmt->execute([$this->idClient]);
    }
}
