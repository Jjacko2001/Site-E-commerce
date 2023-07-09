<?php
class Categorie {
    private $cat_id;
    private $cat_title;
    private $cat_desc;
    private $cat_img;
    private $SubCat;

    public function __construct($id, $title, $desc, $img, $SubCat) {
        $this->cat_id = $id;
        $this->cat_title = $title;
        $this->cat_desc = $desc;
        $this->cat_img = $img;
        $this->SubCat = $SubCat;
    }
    public function getId() {
        return $this->cat_id;
    }

    public function setId($id) {
        $this->cat_id = $id;
    }

    public function getTitle() {
        return $this->cat_title;
    }

    public function setTitle($title) {
        $this->cat_title = $title;
    }

    public function getDesc() {
        return $this->cat_desc;
    }

    public function setDesc($desc) {
        $this->cat_desc = $desc;
    }

    public function getImg() {
        return $this->cat_img;
    }
    
    public function setImg($img) {
        $this->cat_img = $img;
    }
    public function getSubCat() {
          return $this->SubCat;
    }
    public function setSubCat($SubCat) {
      $this->SubCat = $SubCat;
  }

  public static function getAllCategories() {
    include("ConnexionBD.php");

    $requete = "SELECT * FROM category";
    $result= mysqli_query($conn, $requete); 

    
    $categories = array(); //tableau pour stocker les catégories

    // boucle à travers les résultats et crée des objets Categorie
    while ($row = mysqli_fetch_assoc($result)/**$result->fetch_assoc() */) {
      $cat = new Categorie($row['cat_id'], $row['cat_title'], $row['cat_desc'], $row['cat_img'], $row['SubCat']);
      array_push($categories, $cat);
    }
    
    mysqli_close($conn); 
    return $categories;
  }

  
  public function addCategory($categorie) {
    include("ConnexionBD.php");

    $requete ="INSERT INTO category (cat_title, cat_desc, cat_img, SubCat) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $requete);
    mysqli_stmt_bind_param($stmt,"sss", $this->cat_title, $this->cat_desc, $this->cat_img);

    $result = mysqli_stmt_execute($stmt);

    // ferme la connexion du stmt on peut pas use le  mysqli_close($stmt) car c'est une fonction préparée et retourne le résultat de l'insertion
    $stmt->close(); 
    $conn->close();
    return $result;
  }
  public function updateCategory($cat_id, $new_title, $new_desc, $new_img) {
    include("ConnexionBD.php");

    $stmt = $conn->prepare("UPDATE categories SET cat_title = ?, cat_desc = ?, cat_img = ? WHERE cat_id = ?");
    $stmt->bind_param("sssi", $new_title, $new_desc, $new_img, $cat_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  }

  public function deleteCategory($cat_id) {
    include("ConnexionBD.php");
    
    $stmt = $conn->prepare("DELETE FROM categories WHERE cat_id = ?");
    $stmt->bind_param("i", $cat_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  }
 
  public function getCategoryDetails($cat_id) {
    $conn = mysqli_connect("localhost","root","","jourya");

    $requete = "SELECT * FROM category WHERE cat_id = $cat_id";
    $stmt = mysqli_query($conn, $requete);
    

if (mysqli_num_rows($stmt) === 0) {
    return null; 
} else {
    $catData = mysqli_fetch_assoc($stmt);
    
    // Mettre à jour les attributs de l'objet Product avec les détails du produit

    $this->cat_id = $catData['cat_id'];
    $this->cat_title = $catData['cat_title'];
    $this->cat_desc = $catData['cat_desc'];
    $this->setImg($catData['cat_img']);
    $this->SubCat =$catData['SubCat'];

    mysqli_close($conn); 
    return $this; 
}
}

public function geEtCategoryDetails($cat_id) {
    $conn = mysqli_connect("localhost","root","","jourya");

    $requete = "SELECT * FROM category WHERE cat_id = $cat_id";
    $stmt = mysqli_query($conn, $requete);
    

if (mysqli_num_rows($stmt) === 0) {
    return null; 
} else {
    $catData = mysqli_fetch_assoc($stmt);
    
    // Mettre à jour les attributs de l'objet Product avec les détails du produit
    $this->cat_id = $catData['cat_id'];
    $this->cat_title = $catData['cat_title'];
    $this->cat_desc = $catData['cat_desc'];
    $this->cat_img = $catData['cat_img'];
    $this->SubCat = $catData['SubCat'];

    mysqli_close($conn); 
    return $this; 
}
}
public function getAllCat() {
    include("ConnexionBD.php");
    $cus_id = $_SESSION['user_id'];
    
    $requete = "SELECT * FROM category ";
    $result = mysqli_query($conn,$requete);
/* 
    if (mysqli_num_rows($result) == 0) {
        return null; 
    } else { */
        $items = array(); // Tableau pour stocker les Product

        // Parcourir les résultats de la requête et créer des objets Product pour chaque produit
        while ($itemData = mysqli_fetch_assoc($result)) {
            $item = new Categorie("", "", "", "","");//Pas besoin de mettre les arguments   Je pense
            
            $item->setId($itemData['cat_id']);
            $item->setTitle($itemData['cat_title']);
            $item->setSubCat($itemData['SubCat']);

            
            $items[] = $item; // Ajouter l'objet Product au tableau des produits
        }

        return $items; // Retourner le tableau d'objets Product
    }
}