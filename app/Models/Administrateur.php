<?php

// Ici je définit le namespace ou il y aura ma class
namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Administrateur
{
    private $idAdmin;
    private $nomUtilisateur;
    private $email;
    private $motDePasse;
    private $superadmin;

    // =====================
    // Getters / Setters
    // =====================

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;
    }

    public function getnomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur($nomUtilisateur)
    {
        $this->nomUtilisateur = $nomUtilisateur;
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

    public function getSuperadmin()
    {
        return $this->superadmin;
    }

    public function setSuperadmin($superadmin)
    {
        $this->superadmin = $superadmin;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM administrateur ORDER BY id_admin DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     * @param int $id
     * @return array|null
     */
    public static function findByIdAdmin($idAdmin)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM administrateur WHERE id_admin = ?");
        $stmt->execute([$idAdmin]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO administrateur (nom_utilisateur, email, mot_de_passe, superadmin) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$this->nomUtilisateur, $this->email,$this->motDePasse,$this->superadmin]);
    }

    /**
     * Met à jour les informations d’un utilisateur existant
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE administrateur SET nom_utilisateur = ?, email = ?, mot_de_passe= ?, superadmin= ? WHERE id_admin = ?");
        return $stmt->execute([$this->nomUtilisateur, $this->email,$this->motDePasse,$this->superadmin,$this->idAdmin]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM administrateur WHERE id_admin = ?");
        return $stmt->execute([$this->idAdmin]);
    }
}
