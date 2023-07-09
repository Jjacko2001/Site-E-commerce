<?php
class Cart {
    private $cart_id;
    private $cartItems;
    private $cus_id;
    public function __construct() {
        $this->cartItems = array();
    }

    public function getItems() {
        return $this->cartItems;
    }
    public function getCartId() {
        return $this->cart_id;
    }

    public function addItem(CartItem $cartItem) {
        $this->cartItems[] = $cartItem;
    }
    public function setCartId($cart_id) {
        $this->cart_id = $cart_id;
    }
    public function setCusId($cus_id) {
        $this->cus_id = $cus_id;
    }

    public function removeItem($cartItemId) {
        foreach ($this->cartItems as $key => $cartItem) {//donc faut metttre l'attribut et méthode manquants de cartItem le cartItem et getcartItem
            if ($cartItem->getCartItemId() == $cartItemId) {
                unset($this->cartItems[$key]);
                return true;
            }
        }
        return false;
    }

    public function getSubtotal() {
        $subtotal = 0;
        foreach ($this->cartItems as $cartItem) {
            $subtotal += $cartItem->getSubtotal();
        }
        return $subtotal;
    }


    public function updateItemQuantity($cartItemId, $quantity) {
        foreach ($this->cartItems as $key => $cartItem) {
            if ($cartItem->getCartItemId() == $cartItemId) {
                $cartItem->setQuantity($quantity);
                return true;
            }
        }
        return false;
    }

    
    public function getItemCount() {
        $itemCount = 0;
        foreach ($this->cartItems as $cartItem) {
            $itemCount += $cartItem->getQuantity();
        }
        return $itemCount;
    }


    public function getCart($cus_id){
        // Connectez-vous à la base de données ou utilisez votre connexion existante
        $conn = mysqli_connect("localhost","root","","jourya");
    
        // Construisez la requête pour récupérer le panier en fonction de l'ID du client
        $query = "SELECT * FROM cart WHERE cus_id = $cus_id";
        $result = mysqli_query($conn, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            // Récupérez les données du panier dans un tableau associatif
            $cartData = mysqli_fetch_assoc($result);
            $cart = new Cart();
            // Récupérez les informations du panier à partir des données récupérées
            $cart->setCartId($cartData['cart_id']);
            $cart->setCusId($cartData['cus_id']);
    
            
            // Fermez la connexion à la base de données
            mysqli_close($conn);
    
            // Retournez l'objet Cart
            return $cart;
        } else {
            // Aucun panier trouvé pour l'ID du client spécifié
            // Fermez la connexion à la base de données
            mysqli_close($conn);
            
            return ("ca");
        }
    }
    
}