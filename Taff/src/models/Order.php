<?php
class Order {
    public $table_name = "orders";

    private $ord_id;
    private $total;
    private $cus_id;
    private $statut;
    private $adr;//order date et attribut paiement aussi apres

    public function __construct($ord_id, $cus_id, $total, $statut, $adr) {
        $this->ord_id = $ord_id;
        $this->cus_id = $cus_id;
        $this->total = $total;
        $this->statut = $statut;
        $this->adr = $adr;
     
    }

    public function getCusId() {
        return $this->cus_id;
    }

    public function getOrdId() {
        return $this->ord_id;
    }
    public function getTotal() {
        return $this->total;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getAdr() {
        return $this->adr;
    }

    

    public function setOrdId($ord_id) {
        $this->ord_id = $ord_id;
    }

    public function setCusId($cus_id) {
        $this->cus_id = $cus_id;
    }
    public function setTotal($total) {
        $this->total = $total;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    public function setAdr($adr) {
        $this->adr = $adr;
    }


   
    
    public function addOrder($total) {
        $conn = mysqli_connect("localhost","root","","jourya");
        $query = "INSERT INTO 'orders' (cus_id,  total) VALUE ('{$_SESSION['user_id']}', '$total')";
        $stmt = mysqli_query($conn, $query);
    }

    
    public function getOrder() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_order = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_order);
        $stmt->execute();

        // J'ai use pour voir le API pdo numrow et consort
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function getOrderByUser($cus_id) {
        include("../connexion.php");
        $query = "SELECT * FROM Orders WHERE cus_id = $cus_id";
        $stmt = mysqli_query($conn,$query);
        mysqli_close($conn);

        /* if (mysqli_num_rows($stmt)= 0) {
            while($row=mysqli_fetch_assoc($stmt)){

            }
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        } */
    }
    public function getOrderById($ord_id) {
      
    $conn = mysqli_connect("localhost","root","","jourya");
        $query = "SELECT * FROM Orders WHERE ord_id = $ord_id";
        $stmt = mysqli_query($conn,$query);
        

        if (mysqli_num_rows($stmt)> 0) {
            while($row=mysqli_fetch_assoc($stmt)){
                $total=$row['ord_total'];

            }
            return $total;
        
    }}

    public function finalizeOrder() {

        foreach ($_POST as $key => $value) {
            ${$key} = $value;
       
        if (isset($submit1) && (!empty($address)) && (!empty($cardnumber)) ){

        $conn = mysqli_connect("localhost","root","","jourya");
        $requete= "UPDATE `orders` SET `ord_adr`='$address',`paid`='1' WHERE  ord_id = $ord_id";
        // $reque= "UPDATE orders SET ord_adr = $address, cardnumber = $cardnumber, paid = '1' WHERE ord_id = $ord_id";
         $req = mysqli_query($conn, $requete);
        /*if ($req) {
            $_SESSION['success_message'] = "Inscription réussie !";

            
        }
         */
        $cus_id = $_SESSION['user_id'];
        $query = "UPDATE cart_item SET ord_id = $ord_id WHERE cart_id = $cus_id";

        $req1 = mysqli_query($conn, $query);

        mysqli_close($conn);
            
         }
            
        }
    }

    public function updateOrder($prod_id, $cus_id, $payment_id, $etat_order, $order_date) {
       //faut revoir pas besoin d'update tous les attributs
        $query = "UPDATE ". $this->table_name ."SET prod_id=:prod_id, cus_id=:cus_id, payment_id=:payment_id, etat_order=:etat_order, order_date=:order_date WHERE id_order=:id_order";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":prod_id", $prod_id);
        $stmt->bindParam(":cus_id", $cus_id);
        $stmt->bindParam(":payment_id", $payment_id);
        $stmt->bindParam(":etat_order", $etat_order);
        $stmt->bindParam(":order_date", $order_date);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
                  
    public function deleteOrder($id_order) {
        $query = "DELETE FROM orders WHERE id_order = :id_order";
        $stmt = mysqli_query($conn,$query);
        $stmt->bindParam(":id_order", $id_order);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function changeOrderState($id_order, $new_state) {
        $query = "UPDATE orders SET state = :state WHERE id_order = :id_order";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":state", $new_state);
        $stmt->bindParam(":id_order", $id_order);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getPaidOrder() {
        include("ConnexionBD.php");
        $cus_id = $_SESSION['user_id'];
        
        $requete = "SELECT * FROM Orders WHERE cus_id= $cus_id AND paid='1' ";
        $result = mysqli_query($conn,$requete);
    /* 
        if (mysqli_num_rows($result) == 0) {
            return null; 
        } else { */
            $items = array(); // Tableau pour stocker les Product
    
            // Parcourir les résultats de la requête et créer des objets Product pour chaque produit
            while ($itemData = mysqli_fetch_assoc($result)) {
                $item = new Order("", "", "", "","");//Pas besoin de mettre les arguments   Je pense
                $item->setOrdId($itemData['ord_id']);
                $item->setCusId($itemData['cus_id']);
                $item->setTotal($itemData['ord_total']);
                $item->setStatut($itemData['ord_status']);
                $item->setAdr($itemData['ord_adr']);
                
                
                $items[] = $item; // Ajouter l'objet Product au tableau des produits
            }
    
            return $items; // Retourner le tableau d'objets Product
        }

        public function getAllPaidOrder() {
            include("ConnexionBD.php");
            $cus_id = $_SESSION['user_id'];
            
            $requete = "SELECT * FROM Orders WHERE paid='1' ";
            $result = mysqli_query($conn,$requete);
        /* 
            if (mysqli_num_rows($result) == 0) {
                return null; 
            } else { */
                $items = array(); // Tableau pour stocker les Product
        
                // Parcourir les résultats de la requête et créer des objets Product pour chaque produit
                while ($itemData = mysqli_fetch_assoc($result)) {
                    $item = new Order("", "", "", "","");//Pas besoin de mettre les arguments   Je pense
                    $item->setOrdId($itemData['ord_id']);
                    $item->setCusId($itemData['cus_id']);
                    $item->setTotal($itemData['ord_total']);
                    $item->setStatut($itemData['ord_status']);
                    $item->setAdr($itemData['ord_adr']);
                    
                    
                    $items[] = $item; // Ajouter l'objet Product au tableau des produits
                }
        
                return $items; // Retourner le tableau d'objets Product
            }
    }

                