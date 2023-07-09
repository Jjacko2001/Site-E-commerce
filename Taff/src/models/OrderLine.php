<?php
class OrderLine {
    private $conn;
    private $ord_id;
    private $prod_id;
    private $ol_qte;
    private $unit_price;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addOrderLine() {
        $requete = "INSERT INTO order_line (ord_id, prod_id, ol_qte, unit_price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($requete);
        $stmt->bind_param("iiid", $this->ord_id, $this->prod_id, $this->ol_qte, $this->unit_price);
        $result = $stmt->execute();

        if ($result) {
            return true; //true si l'ajout de la ligne de commande est réussi
        } else {
            return false; //false sinon
        }
    }

    public function updateOrderLine() {
        $requete = "UPDATE order_line SET ol_qte = ?, unit_price = ? WHERE ord_id = ? AND prod_id = ?";
        $stmt = $this->conn->prepare($requete);
        $stmt->bind_param("idi", $this->ol_qte, $this->unit_price, $this->ord_id, $this->prod_id);
        $result = $stmt->execute();

        if ($result) {
            return true; // Retourner true si la mise à jour de la ligne de commande est réussie
        } else {
            return false; // Retourner false si la mise à jour de la ligne de commande a échoué
        }
    }

    public function deleteOrderLine() {
        $requete = "DELETE FROM order_lines WHERE ord_id = ? AND prod_id = ?";
        $stmt = $this->conn->prepare($requete);
        $stmt->bind_param("ii", $this->ord_id, $this->prod_id);
        $result = $stmt->execute();

        if ($result) {
            return true; // Retourner true si la suppression de la ligne de commande est réussie
        } else {
            return false; // Retourner false si la suppression de la ligne de commande a échoué
        }
    }
}
