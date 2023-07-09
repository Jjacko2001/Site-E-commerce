<?php

class Promotion {
    private $promo_id;
    private $promo_nom;
    private $promo_desc;
    private $promo_pourcentage;
    private $promo_date_debut;
    private $promo_date_fin;

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function setPromoId($promo_id) {
        $this->promo_id = $promo_id;
    }

    public function getPromoId() {
        return $this->promo_id;
    }

    public function setPromoNom($promo_nom) {
        $this->promo_nom = $promo_nom;
    }

    public function getPromoNom() {
        return $this->promo_nom;
    }

    public function setPromoDesc($promo_desc) {
        $this->promo_desc = $promo_desc;
    }

    public function getPromoDesc() {
        return $this->promo_desc;
    }

    public function setPromoPourcentage($promo_pourcentage) {
        $this->promo_pourcentage = $promo_pourcentage;
    }

    public function getPromoPourcentage() {
        return $this->promo_pourcentage;
    }

    public function setPromoDateDebut($promo_date_debut) {
        $this->promo_date_debut = $promo_date_debut;
    }

    public function getPromoDateDebut() {
        return $this->promo_date_debut;
    }

    public function setPromoDateFin($promo_date_fin) {
        $this->promo_date_fin = $promo_date_fin;
    }

    public function getPromoDateFin() {
        return $this->promo_date_fin;
    }

    public function addPromotion() {
        $requete = "INSERT INTO promotions (promo_nom, promo_desc, promo_pourcentage, promo_date_debut, promo_date_fin) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($requete);
        $stmt->bind_param("ssdss", $this->promo_nom, $this->promo_desc, $this->promo_pourcentage, $this->promo_date_debut, $this->promo_date_fin);
        $result = $stmt->execute();

        if ($result) {
            $this->promo_id = $stmt->insert_id; // Récupérer l'ID de la promotion nouvellement insérée
            return true; // Retourner true si l'ajout de la promotion est réussi
        } else {
            return false; // Retourner false si l'ajout de la promotion a échoué
        }
    }

    public function updatePromotion() {
        $requete = "UPDATE promotions SET promo_nom = ?, promo_desc = ?, promo_pourcentage = ?, promo_date_debut = ?, promo_date_fin = ? WHERE promo_id = ?";
        $stmt = $this->conn->prepare($requete);
        $stmt->bind_param("ssdssi", $this->promo_nom, $this->promo_desc, $this->promo_pourcentage, $this->promo_date_debut, $this->promo_date_fin, $this->promo_id);
        $result = $stmt->execute();

        return $result; // Retourner true si la mise à jour est réussie, false sinon
    }

    public function deletePromotion() {
        $requete = "DELETE FROM promotions WHERE promo_id = ?";
        $stmt = $this->conn->prepare($requete);
        $stmt->































        class Promotion {

            private $conn;
        
            public $promo_id;
            public $promo_code;
            public $promo_value;
            public $promo_type;
            public $promo_start;
            public $promo_end;
        
            public function __construct($db) {
                $this->conn = $db;
            }
        
            // Récupérer toutes les promotions
            public function getPromotions() {
                $query = "SELECT * FROM promotions";
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result;
            }
        
            // Récupérer une promotion par son ID
            public function getPromotionById($promo_id) {
                $query = "SELECT * FROM promotions WHERE promo_id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $promo_id);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            }
        
            // Ajouter une nouvelle promotion
            public function addPromotion() {
                $query = "INSERT INTO promotions (promo_code, promo_value, promo_type, promo_start, promo_end) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sdsss", $this->promo_code, $this->promo_value, $this->promo_type, $this->promo_start, $this->promo_end);
                $result = $stmt->execute();
                if ($result) {
                    $this->promo_id = $stmt->insert_id;
                    return true;
                } else {
                    return false;
                }
            }
        
            // Mettre à jour une promotion
            public function updatePromotion() {
                $query = "UPDATE promotions SET promo_code = ?, promo_value = ?, promo_type = ?, promo_start = ?, promo_end = ? WHERE promo_id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sdsssi", $this->promo_code, $this->promo_value, $this->promo_type, $this->promo_start, $this->promo_end, $this->promo_id);
                $result = $stmt->execute();
                if ($result) {
                    return true;
                } else {
                    return false;
                }
            }
        
            // Supprimer une promotion
            public function deletePromotion() {
                $query = "DELETE FROM promotions WHERE promo_id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("i", $this->promo_id);
                $result = $stmt->execute();
                if ($result) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        