<?php

class Admin {

    private $conn;
    private $table_name = "admins";

    public $admin_id;
    public $admin_name;
    public $admin_email;
    public $admin_password;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Enregistrer un nouvel administrateur
    public function register() {
        // Vérifier si l'adresse email est déjà utilisée
        $query = "SELECT admin_id FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->admin_email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // L'adresse email est déjà utilisée
            return false;
        } else {
            // Ajouter un nouvel administrateur
            $query = "INSERT INTO " . $this->table_name . " (admin_name, admin_email, admin_password) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("sss", $this->admin_name, $this->admin_email, $this->admin_password);
            $result = $stmt->execute();
            if ($result) {
                $this->admin_id = $stmt->insert_id;//Revoir ici
                return true;
            } else {
                return false;
            }
        }
    }

    // Connecter un administrateur
    public function login() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE admin_email = ? AND admin_password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->admin_email, $this->admin_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->admin_id = $row['admin_id'];
            $this->admin_name = $row['admin_name'];
            return true;
        } else {
            return false;
        }
    }

    // Mettre à jour le profil de l'administrateur
    public function updateProfile() {
        $query = "UPDATE " . $this->table_name . " SET admin_name = ? WHERE admin_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->admin_name, $this->admin_id);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // Changer le mot de passe de l'administrateur
    public function changePassword() {
        $query = "UPDATE " . $this->table_name . " SET admin_password = ? WHERE admin_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->admin_password, $this->admin_id);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function setAdmin() {
        $query = "UPDATE customer SET admin = 1 WHERE cus_id = $.";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->admin_password, $this->admin_id);
        $result = $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}

