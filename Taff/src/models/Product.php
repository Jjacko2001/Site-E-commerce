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
        $conn = mysqli_connect("localhost","root","","jourya");

        $requete = "SELECT * FROM product WHERE prod_id = $prod_id";
        $stmt = mysqli_query($conn, $requete);
        

    if (mysqli_num_rows($stmt) === 0) {
        return null; 
    } else {
        $productData = mysqli_fetch_assoc($stmt);
        
        // Mettre à jour les attributs de l'objet Product avec les détails du produit
        $this->prod_id = $productData['prod_id'];
        $this->prod_name = $productData['prod_name'];
        $this->prod_desc = $productData['prod_desc'];
        $this->prod_prix = $productData['prod_price'];
        $this->prod_qte_dispo = $productData['prod_qte'];
        $this->setProdImg($productData['prod_img']);
        $this->cat_id = $productData['cat_id'];

        mysqli_close($conn); 
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
            $product->setProdId($productData['prod_id']);
            $product->setProdName($productData['prod_name']);
            $product->setProdDesc($productData['prod_desc']);
            $product->setProdPrix($productData['prod_prix']);
            $product->setProdQteDispo($productData['prod_qte_dispo']);
            $product->setProdImg($productData['prod_img']);
            $product->setCatId($productData['cat_id']);
            $products[] = $product; // Ajouter l'objet Product au tableau des produits
        }

        return $products; // Retourner le tableau d'objets Product
    }
}

public function getProductsByCategory($category_id) {
    
    $conn = mysqli_connect("localhost","root","","jourya");
           

    $query = "SELECT * FROM product WHERE cat_id = $category_id";
    $stmt = mysqli_query($conn,$query);
    
    $products = array(); 
    while ($row = mysqli_fetch_assoc($stmt)) {
      $prod = new Product($row['prod_id'], $row['prod_name'], $row['prod_desc'], $row['prod_price'], $row['prod_qte_dispo'], $row['prod_img'], $row['cat_id']);
      array_push($products, $prod);
    }
    if(mysqli_num_rows($stmt)<1)
    {
     
     return 2;
    }
    else {return $products;}
    
    


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

public function searchProducts($searchTerm) {    
    $conn = mysqli_connect("localhost","root","","jourya");
    $query = "SELECT * FROM product WHERE prod_name LIKE '%" . $searchTerm . "%'";
    $stmt= mysqli_query($conn, $query);
    
    // Ajouter les valeurs et les types de données des paramètres à la requête
    
    $products = array(); 
    
    while ($row = mysqli_fetch_assoc($stmt)) {
      $prod = new Product($row['prod_id'], $row['prod_name'], $row['prod_desc'], $row['prod_price'], $row['prod_qte_dispo'], $row['prod_img'], $row['cat_id']);
      array_push($products, $prod);
    }
     
    if(mysqli_num_rows($stmt)<1)
    {
     
     return 2;
    }
    else {return $products;}
    
    
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



        public function getProductsRandom4() {
    
            $conn = mysqli_connect("localhost","root","","jourya");
                   
        
            $query = "SELECT * FROM product ORDER BY RAND() LIMIT 4";
            $stmt = mysqli_query($conn,$query);
            
            $products = array(); 
            while ($row = mysqli_fetch_assoc($stmt)) {
              $prod = new Product($row['prod_id'], $row['prod_name'], $row['prod_desc'], $row['prod_price'], $row['prod_qte_dispo'], $row['prod_img'], $row['cat_id']);
              array_push($products, $prod);
            }
            if(mysqli_num_rows($stmt)<1)
            {
             
             return 2;
            }
            else {return $products;}
        }
    
    
    public function getProductsRandom8() {
    
        $conn = mysqli_connect("localhost","root","","jourya");
               
    
        $query = "SELECT * FROM product ORDER BY RAND() LIMIT 8";
        $stmt = mysqli_query($conn,$query);
        
        $products = array(); 
        while ($row = mysqli_fetch_assoc($stmt)) {
          $prod = new Product($row['prod_id'], $row['prod_name'], $row['prod_desc'], $row['prod_price'], $row['prod_qte_dispo'], $row['prod_img'], $row['cat_id']);
          array_push($products, $prod);
        }
        if(mysqli_num_rows($stmt)<1)
        {
         
         return 2;
        }
        else {return $products;}
    }
    
    public function getAllProd() {
        include("ConnexionBD.php");
        $cus_id = $_SESSION['user_id'];
        
        $requete = "SELECT * FROM product  ";
        $result = mysqli_query($conn,$requete);
    /* 
        if (mysqli_num_rows($result) == 0) {
            return null; 
        } else { */
            $items = array(); // Tableau pour stocker les Product
    
            // Parcourir les résultats de la requête et créer des objets Product pour chaque produit
            while ($itemData = mysqli_fetch_assoc($result)) {
                $item = new Product("", "", "", "","", "", "");//Pas besoin de mettre les arguments   Je pense
                
                $item->setProdId($itemData['prod_id']);
                $item->setProdName($itemData['prod_name']);
                $item->setProdPrix($itemData['prod_price']);
                $item->setProdQteDispo($itemData['prod_qte']);
                $item->setProdImg($itemData['prod_img']);
                $item->setCatId($itemData['cat_id']);
                
                $items[] = $item; // Ajouter l'objet Product au tableau des produits
            }
    
            return $items; // Retourner le tableau d'objets Product
        }
        public function getProductsNbre() {
    
            $conn = mysqli_connect("localhost","root","","jourya");
      
            $query = "SELECT COUNT(*) AS nbr FROM product ";
            $stmt = mysqli_query($conn,$query);
            
            $row = mysqli_fetch_assoc($stmt);
            return $row['nbr'];
        }
}
            
            