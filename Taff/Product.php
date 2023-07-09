<?php
class Product {
    private $prod_id;
    private $prod_name;
    private $prod_desc;
    private $prod_prix;
    private $prod_qte_dispo;
    private $prod_img;
    private $cat_id; // Ici bizarre un peu On veut travailler directement un objet categorie donc je pense que ce n'est pas que l'id je vais mettre, et revoir le getter et setter         
//ou bien c'est dans le setter on fait le choix de la categorie.
//Non tkt c'est bon
    public function __construct($prod_id, $prod_name, $prod_desc, $prod_prix, $prod_qte_dispo, $prod_img, $cat_id) {
        $this->prod_id = $prod_id;
        $this->prod_name = $prod_name;
        $this->prod_desc = $prod_desc;
        $this->prod_prix = $prod_prix;
        $this->prod_qte_dispo = $prod_qte_dispo;
        $this->prod_img = $prod_img;
        $this->cat_id = $cat_id;// Ca reste bizarre ici
    }

    public function getProdId() {
        return $this->prod_id;
    }

    public function getProdName() {
        return $this->prod_name;
    }

    public function getProdDesc() {
        return $this->prod_desc;
    }

    public function getProdPrix() {
        return $this->prod_prix;
    }

    public function getProdQteDispo() {
        return $this->prod_qte_dispo;
    }

    public function getProdImg() {
        return $this->prod_img;
    }

    public function getCatId() {// Ca reste bizarre ici
        return $this->cat_id;
    }

    public function setProdId($prod_id) {
        $this->prod_id = $prod_id;
    }

    public function setProdName($prod_name) {
        $this->prod_name = $prod_name;
    }

    public function setProdDesc($prod_desc) {
        $this->prod_desc = $prod_desc;
    }

    public function setProdPrix($prod_prix) {
        $this->prod_prix = $prod_prix;
    }

    public function setProdQteDispo($prod_qte_dispo) {
        $this->prod_qte_dispo = $prod_qte_dispo;
    }

    public function setProdImg($prod_img) {
        $this->prod_img = $prod_img;
    }

    public function setCatId($cat_id) {// Ca reste bizarre ici
        $this->cat_id = $cat_id;
    }



    public function getProductDetails($prod_id) {
        include("ConnexionBD.php");
    
        $requete = "SELECT * FROM products WHERE prod_id = ?";
        $stmt = mysqli_prepare($conn, $requete);
        $stmt->bind_param("i", $prod_id);//requêtes sécurisées pour éviter les attaques par injection SQL
        $stmt->execute();
        $result = $stmt->get_result();//fonction prédéfinie pour un mysqli_result déjà préparé

    if ($result->num_rows === 0) {
        return null; 
    } else {
        $productData = $result->fetch_assoc();
        // Mettre à jour les attributs de l'objet Product avec les détails du produit
        $this->prod_id = $productData['prod_id'];
        $this->prod_name = $productData['prod_name'];
        $this->prod_desc = $productData['prod_desc'];
        $this->prod_prix = $productData['prod_prix'];
        $this->prod_qte_dispo = $productData['prod_qte_dispo'];
        $this->prod_img = $productData['prod_img'];
        $this->cat_id = $productData['cat_id'];

        return $this; 
    }
}

 public function getAllProducts() {
    include("ConnexionBD.php");
    
    $requete = "SELECT * FROM products";
    $result = mysqli_query($conn,$requete);

    if ($result->num_rows === 0) {
        return null; 
    } else {
        $products = array(); // Tableau pour stocker les Product

        // Parcourir les résultats de la requête et créer des objets Product pour chaque produit
        while ($productData = $result->fetch_assoc()) {
            $product = new Product($prod_id, $prod_name, $prod_desc, $prod_prix, $prod_qte_dispo, $prod_img, $cat_id);//Pas besoin de mettre les arguments   Je pense
            $product->setProductId($productData['prod_id']);
            $product->setProductName($productData['prod_name']);
            $product->setProductDescription($productData['prod_desc']);
            $product->setProductPrice($productData['prod_prix']);
            $product->setProductQuantity($productData['prod_qte_dispo']);
            $product->setProductImage($productData['prod_img']);
            $product->setCategoryId($productData['cat_id']);
            $products[] = $product; // Ajouter l'objet Product au tableau des produits
        }

        return $products; // Retourner le tableau d'objets Product
    }
}

public function getProductsByCategory($category_id) {
    require_once("ConnexionBD.php");

    $query = "SELECT * FROM product WHERE cat_id = $category_id";
    $stmt = mysqli_query($conn,$query);
    
    $products = array(); 
    while ($row = mysqli_fetch_assoc($stmt)) {
      $prod = new Product($row['prod_id'], $row['prod_name'], $row['prod_desc'], $row['prod_prix'], $row['prod_qte_dispo'], $row['prod_img'], $row['cat_id']);
      array_push($products, $prod);
    }
    
    mysqli_close($conn); 
    return $products;


/* 
        while ($productData = $result->fetch_assoc()) {
            $product = new Product($prod_id, $prod_name, $prod_desc, $prod_prix, $prod_qte_dispo, $prod_img, $cat_id);//Pas besoin de mettre les arguments   Je pense
            $product->setProductId($productData['prod_id']);
            $product->setProductName($productData['prod_name']);
            $product->setProductDescription($productData['prod_desc']);
            $product->setProductPrice($productData['prod_prix']);
            $product->setProductQuantity($productData['prod_qte_dispo']);
            $product->setProductImage($productData['prod_img']);
            $product->setCategoryId($productData['cat_id']);
            $products[] = $product; // Ajouter l'objet Product au tableau des produits
        }

        return $products; // Retourner le tableau d'objets Product */
    
}





 
 public function addProduct() {
    include("ConnexionBD.php");

    $requete = "INSERT INTO products (prod_name, prod_desc, prod_prix, prod_qte_dispo, prod_img, cat_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $this->$conn->prepare($requete);
    $stmt->bind_param("ssdissi", $this->prod_name, $this->prod_desc, $this->prod_prix, $this->prod_qte_dispo, $this->prod_img, $this->cat_id);
    $result = $stmt->execute();
    //la fonction là n'est pas trop importante. Juste verifier si la requete a marché
    if ($result) {
        $this->prod_id = $stmt->insert_id; //une méthode de l'objet mysqli_stmt qui permet de récupérer l'identifiant (ID) auto-incrémenté généré lors de l'insertion d'un enregistrement dans la base de données. Récupérer l'ID du produit nouvellement inséré
        return true; // Retourner true si l'ajout du produit est réussi
    } else {
        return false; 
    }
}

public function updateProduct() {
    include("ConnexionBD.php");

    $requete = "UPDATE products SET prod_name = ?, prod_desc = ?, prod_prix = ?, prod_qte_dispo = ?, prod_img = ?, cat_id = ? WHERE prod_id = ?";
    $stmt = $this->$conn->prepare($requete);
    $stmt->bind_param("ssdissii", $this->prod_name, $this->prod_desc, $this->prod_prix, $this->prod_qte_dispo, $this->prod_img, $this->cat_id, $this->prod_id);
    $result = $stmt->execute();

    return $result; // True si l'update est réussie
}

public function deleteProduct() {
    include("ConnexionBD.php");

    $query = "DELETE FROM products WHERE prod_id = ?";
    $stmt = $this->$conn->prepare($query);
    $stmt->bind_param("i", $this->prod_id);
    $result = $stmt->execute();

    return $result; 
}


public function getProductImage() {
    include("ConnexionBD.php");

    $query = "SELECT prod_img FROM products WHERE prod_id = ? ";
    $stmt = $this->$conn->prepare($query);
    $stmt->bind_param("is", $this->prod_id, $this->prod_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['prod_img']; // Retourner l'URL de l'image du produit
    } else {
        return null; 
    }
}

public function searchProducts($searchTerm, $minPrice = null, $maxPrice = null) {
    include("ConnexionBD.php");

    $query = "SELECT * FROM products WHERE prod_name LIKE ? AND prod_prix >= ? AND prod_prix <= ?";
    $stmt = $this->$conn->prepare($query);

    // Ajouter les valeurs et les types de données des paramètres à la requête
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("sdd", $searchTerm, $minPrice, $maxPrice);
    $stmt->execute();
    $result = $stmt->get_result();

    // Retourner les résultats de la recherche sous forme de tableau d'objets Product
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $product = new Product($prod_id, $prod_name, $prod_desc, $prod_prix, $prod_qte_dispo, $prod_img, $cat_id);//Pas besoin de mettre les arguments   Je pense
        $product->setProdId($row['prod_id']);
        $product->setProdName($row['prod_name']);
        $product->setProdDesc($row['prod_desc']);
        $product->setProdPrix($row['prod_prix']);
        $product->setProdQteDispo($row['prod_qte_dispo']);
        $product->setProdImg($row['prod_img']);
        $product->setCatId($row['cat_id']);
        $products[] = $product;
    }

    return $products; // Retourner le tableau d'objets Product correspondant à la recherche
}
function getProductAvailability($prodId) {
    include("ConnexionBD.php");

    $query = "SELECT prod_qte_dispo FROM products WHERE prod_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $prodId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $qteDispo = $row['prod_qte_dispo'];
    $stmt->close();
    return $qteDispo;

}
public function updateProductStock($prod_id, $qtyToMinus){
    include("ConnexionBD.php");

    $query = "UPDATE products SET prod_qte_dispo = prod_qte_dispo - ? WHERE prod_id = ?";
    $stmt = $this->$conn->prepare($query);
    $stmt->bind_param("ii", $qtyToMinus, $prod_id);
    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }
}
}

//je vais faire plus tard la fonction view produit