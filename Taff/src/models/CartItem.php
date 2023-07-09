<?php

class CartItem {
    private $cart_id;
    private $prod_id;
    private $qte;
    private $unit_price;
    
    //donc faut metttre l'attribut et méthode manquants de cartItem le cartItem et getcartItem pour la classe Cart.

    public function __construct($cartId, $prod_id, $quantity, $unit_price) {
        $this->cart_id = $cartId;
        $this->prod_id = $prod_id;
        $this->qte = $quantity;
        $this->unit_price = $unit_price;
       
    }

    public function getCartId() {
        return $this->cart_id;
    }

    public function getProdId() {
        return $this->prod_id;
    }

    public function getQuantity() {
        return $this->qte;
    }

    public function getUnitPrice() {
        return $this->unit_price;
    }

    public function setQuantity($quantity) {
        $this->qte = $quantity;
    }
    public function setCartId($cart_id) {
        $this->cart_id = $cart_id;
    }
    public function setProdId($prod_id) {
        $this->prod_id = $prod_id;
    }
    public function setUnitPrice($unitPrice) {
        $this->unit_price = $unitPrice;
    }
    
    public function getSubtotal() {
        $unitPrice = floatval($this->unit_price);
        $quantity = intval($this->qte);
    
        return $unitPrice * $quantity;
    }
    

    public function getAllCI($cart_id) {
        include("ConnexionBD.php");
        
        $requete = "SELECT * FROM cart_item WHERE cart_id= $cart_id and dejaPaye='0' ";
        $result = mysqli_query($conn,$requete);
    
        if ($result->num_rows === 0) {
            return null; 
        } else {
            $items = array(); // Tableau pour stocker les Product
    
            // Parcourir les résultats de la requête et créer des objets Product pour chaque produit
            while ($itemData = $result->fetch_assoc()) {
                $item = new CartItem("", "", "", "");//Pas besoin de mettre les arguments   Je pense
                $item->setCartId($itemData['cart_id']);
                $item->setProdId($itemData['prod_id']);
                $item->setQuantity($itemData['qte']);
                $item->setUnitPrice($itemData['unit_price']);
                
                $items[] = $item; // Ajouter l'objet Product au tableau des produits
            }
    
            return $items; // Retourner le tableau d'objets Product
        }
    }
    public function insertCartItem($cartItem) {
        $conn = mysqli_connect("localhost", "root", "", "jourya");
    
        // Échapper les valeurs pour éviter les injections SQL
        $cartId = mysqli_real_escape_string($conn, $cartItem->getCartId());
        $prodId = mysqli_real_escape_string($conn, $cartItem->getProdId());
        $quantity = mysqli_real_escape_string($conn, $cartItem->getQuantity());
        $unit_price = mysqli_real_escape_string($conn, $cartItem->getUnitPrice());
    
        // Vérifier si le produit existe déjà dans la base de données
        $existingQuery = "SELECT * FROM cart_item WHERE cart_id = '$cartId' AND prod_id = '$prodId' AND dejaPaye = '0'";
        $existingResult = mysqli_query($conn, $existingQuery);
        if (mysqli_num_rows($existingResult) > 0) {
            // Le produit existe déjà, mettre à jour la quantité
            $existingData = mysqli_fetch_assoc($existingResult);
            $existingQuantity = $existingData['qte'];
            $newQuantity = $existingQuantity + $quantity;
    
            // Mettre à jour la quantité du produit existant
            $updateQuery = "UPDATE cart_item SET qte = '$newQuantity' WHERE cart_id = '$cartId' AND prod_id = '$prodId'";
            mysqli_query($conn, $updateQuery);
        } else {
            // Le produit n'existe pas, effectuer l'insertion normale
            $insertQuery = "INSERT INTO cart_item (cart_id, prod_id, qte, unit_price) 
                            VALUES ('$cartId', '$prodId', '$quantity', '$unit_price')";
            mysqli_query($conn, $insertQuery);
        }
    
        mysqli_close($conn);
    }
    
public function removeCartItem($cartId, $prodId) {
    $conn = mysqli_connect("localhost", "root", "", "jourya");

    // Échapper les valeurs pour éviter les injections SQL
    $cartId = mysqli_real_escape_string($conn, $cartId);
    $prodId = mysqli_real_escape_string($conn, $prodId);

    // Construire la requête de suppression
    $query = "DELETE FROM cart_item WHERE cart_id = '$cartId' AND prod_id = '$prodId'";
    
    // Exécuter la requête
    mysqli_query($conn, $query);

    mysqli_close($conn);
}

public function getNbreItemCartPresent() {
    
    $conn = mysqli_connect("localhost","root","","jourya");
           
    $user_id = $_SESSION['user_id'];
    $query = "SELECT COUNT(*) AS ttl FROM cart_item WHERE cart_id = $user_id and dejaPaye= '0' ";
    $stmt = mysqli_query($conn,$query);
    $row= mysqli_fetch_assoc($stmt);
    $_SESSION['nbItemCart'] = $row['ttl'];
    return $row['ttl'];

}
}