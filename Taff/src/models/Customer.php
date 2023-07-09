<?php
class Customer {
    private $cus_id;
    private $cus_email;
    private $cus_username;
    private $cus_password;
    private $cus_lastName;
    private $cus_firstName;
    private $cus_address;
    private $cus_tel;
    private $cart_id;
    private $cus_admin;

    public function __construct($cus_id, $cus_email, $cus_username, $cus_password, $cus_lastName, $cus_firstName, $cus_address, $cus_tel, $cart_id) {
        $this->cus_id = $cus_id;
        $this->cus_email = $cus_email;
        $this->cus_username = $cus_username;
        $this->cus_password = $cus_password;
        $this->cus_lastName = $cus_lastName;
        $this->cus_firstName = $cus_firstName;
        $this->cus_address = $cus_address;
        $this->cus_tel = $cus_tel;
        $this->cart_id =$cart_id;
    }

                public function getCusId() {
                    return $this->cus_id;
                }

                public function getCusEmail() {
                    return $this->cus_email;
                }
                public function getCusUsername() {
                    return $this->cus_username;
                }

                public function getCusPassword() {
                    return $this->cus_password;
                }

                public function getCusLastName() {
                    return $this->cus_lastName;
                }

                public function getCusFirstName() {
                    return $this->cus_firstName;
                }

                public function getCusAddress() {
                    return $this->cus_address;
                }

                public function getCusTel() {
                    return $this->cus_tel;
                }
                public function getCartId() {
                    return $this->cart_id;
                }
                public function getCusAdmin() {
                    return $this->cus_admin;
                }
                
        public function setCusId($cus_id) {
            $this->cus_id = $cus_id;
        }

        public function setCusEmail($cus_email) {
            $this->cus_email = $cus_email;
        }
        public function setCusUsername($cus_username) {
            $this->cus_username = $cus_username;
        }

        public function setCusPassword($cus_password) {
            $this->cus_password = $cus_password;
        }

        public function setCusLastName($cus_lastName) {
            $this->cus_lastName = $cus_lastName;
        }

        public function setCusFirstName($cus_firstName) {
            $this->cus_firstName = $cus_firstName;
        }

        public function setCusAddress($cus_address) {
            $this->cus_address = $cus_address;
        }

        public function setCusTel($cus_tel) {
            $this->cus_tel = $cus_tel;
        }
        public function setCartId($cart_id) {
            $this->cart_id = $cart_id;
        }
        public function setCusAdmin($cus_admin) {
            $this->cus_admin = $cus_admin;
        }

    public function register() {

        foreach ($_POST as $key => $value) {
            ${$key} = $value;
        }
        global $message;
        if(empty($uname)){ $message.="<li>Enter your Username!  </li> "; }
                                        if(empty($fname)){ $message.="<li> Enter your FirstName! </li> "; }
                                        if(empty($lname)){ $message.="<li>Enter your LastName!  </li> "; }
                                        if(empty($email)){ $message.="<li> Enter your Mail! </li> "; }
                                        if(empty($pass)){ $message.="<li>Enter your Password!  </li> "; }
        if ((isset($submit)) && (!empty($uname)) && (!empty($fname)) && (!empty($lname)) && (!empty($email)) && (!empty($pass))){

        $conn = mysqli_connect("localhost","root","","jourya");
        $reque= "INSERT INTO customer (cus_username, cus_firstname, cus_lastname, cus_email, cus_password) 
        VALUES ('$uname', '$fname','$lname','$email', '$pass')";
         $req = mysqli_query($conn, $reque);if ($req) {
            $_SESSION['success_message'] = "Inscription réussie !";
            
            // Récupérer l'identifiant du client inséré
            $cus_id = mysqli_insert_id($conn);
            
            // Mettre à jour la colonne cart_id avec la valeur de cus_id
            $req3 = "UPDATE customer SET cart_id = $cus_id WHERE cus_id = $cus_id";
            $stmt = mysqli_query($conn, $req3);
        } 
        
        mysqli_close($conn);
            
         }
         
            
        }
                
        






    public function checkExistingCustomer() {
        include("ConnexionBD.php");
        
        $email = $_POST['email']; // Échappez et sécurisez toujours les entrées utilisateur
        
        $queryResult = mysqli_query($conn, "SELECT cus_id FROM customers WHERE cus_email =$email");
        
        if ($queryResult) {
            $num_rows = mysqli_num_rows($queryResult);
            mysqli_free_result($queryResult);
        } else {
            $num_rows = 0; // La requête a échoué, aucun résultat
        }
        
        
    
        // Retourne true si le client existe, false sinon
        return $num_rows > 0;
    }
    
       
        public function validateCustomerData() {
            // Vérification des données du client
            if (empty($this->cus_email) || empty($this->cus_password) || empty($this->cus_lastName) || empty($this->cus_firstName) || empty($this->cus_address) || empty($this->cus_tel)) {
                return false;
            }
    
            // Validation supplémentaire des si je veux
            return true;// Retourne true si les données sont valides
        }


        public function login() {
            include("ConnexionBD.php");
            global $login_err;
            global $empty_fields;
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Valider les entrées du formulaire
                $username = $_POST['uname'];
                $password = $_POST['pass'];
        
                if (empty($username) || empty($password)) {
                    $empty_fields = true;
                } else {
                    // Connexion à la base de données
                    $conn = mysqli_connect("localhost", "root", "", "jourya");
        
                    if (!$conn) {
                        die("Erreur de connexion à la base de données: " . mysqli_connect_error());
                    }
        
                    // Requête pour récupérer les informations de l'utilisateur
                    $query = "SELECT cus_id, cus_username, cus_firstname, cus_password, cus_admin FROM customer WHERE cus_username = ?";
                    $stmt = mysqli_prepare($conn, $query);
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
        
                    if ($result) {
                        if (mysqli_num_rows($result) === 1) {
                            $row = mysqli_fetch_assoc($result);
                            $user_id = $row['cus_id'];
                            $user_fn = $row['cus_firstname'];
                            $hashed_password = $row['cus_password'];
                            $admin = $row['cus_admin'];
        
                            // Vérifier le mot de passe
                            // if (password_verify($password, $hashed_password))
                            if ($password == $hashed_password) {
                                // Mot de passe correct, création de la session de connexion
        
                                $_SESSION['loggedin'] = true;
                                $_SESSION['user_id'] = $user_id;
                                $_SESSION['username'] = $username;
                                $_SESSION['firstname'] = $user_fn;
                                
                                if ($admin == 1) {
                                    // Redirection vers la page admin.php
                                    header('location: contr_admin.php');
                                } else {
                                    // Redirection vers la page d'accueil
                                    header('location: ../../index.php');
                                }
                                exit;
                            } else {
                                // Mot de passe incorrect
                                $login_err = true;
                            }
                        } else {
                            // Nom d'utilisateur introuvable
                            $login_err = true;
                        }
                    } else {
                        echo "Erreur de requête : " . mysqli_error($conn);
                    }
        
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                }
            }
        }
        





        
    public function updateProfile($cus_id, $cus_lastName, $cus_firstName, $cus_address, $cus_tel)
    {
        include("ConnexionBD.php");
        $query = "UPDATE customers SET cus_lastName = ?, cus_firstName = ?, cus_address = ?, cus_tel = ? WHERE cus_id = ?";
        $stmt = $this->$conn->prepare($query);
        $stmt->bind_param("ssssi", $cus_lastName, $cus_firstName, $cus_address, $cus_tel, $cus_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    public function update() {
        $cus_id = $_SESSION['user_id'];
        //global $msg;
        foreach ($_POST as $key => $value) {
            ${$key} = $value;
    }
    if (isset($submit2)) {
            if (!empty($mail)) {

                    $conn = mysqli_connect("localhost", "root", "", "jourya");
                    if (!$conn) {
                            die("Erreur de connexion à la base de données: " . mysqli_connect_error());
                    }

                    $reque1 = "UPDATE customer SET cus_email = '$mail' WHERE cus_id = $cus_id";
                    $req1 = mysqli_query($conn, $reque1);
                    if (!$req1) {
                            die("Erreur lors de la mise à jour de l'e-mail: " . mysqli_error($conn));
                    }
            }
            /* echo "<div style='font_size:4em'>".$mail."</div>"; */

            if (!empty($Phone)) {

                    $conn = mysqli_connect("localhost", "root", "", "jourya");
                    $reque2 = "UPDATE customer SET cus_tel = '$Phone' WHERE cus_id = $cus_id";
                    $req2 = mysqli_query($conn, $reque2);
                    if (!$req2) {
                            die("Erreur lors de la mise à jour de l'e-mail: " . mysqli_error($conn));
                    }
            }


if((!empty($NPass)) && (!empty($CPass)) && ($NPass==$CPass)){

$conn = mysqli_connect("localhost","root","","jourya");
$reque3= "UPDATE customer SET cus_password = '$NPass' WHERE cus_id = $cus_id";
$req3 = mysqli_query($conn, $reque3);
/* if (!$req) {
$message .= "Mots de passe non identiques<br>";
} */
}


    }
            
        }
                
             
    public function deleteAccount($cus_id)
    {
        include("ConnexionBD.php");
        $query = "DELETE FROM customers WHERE cus_id = ?";
        $stmt = $this->$conn->prepare($query);
        $stmt->bind_param("i", $cus_id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
    
    // Pour déconnecter le client
    public function logout()
    {
        session_unset();
        session_destroy();
        // Rediriger vers la page de connexion
        header("Location: NotreControlerlogin.php");
        exit;
    }
    public function getCusDetails($cus_id) {
        $conn = mysqli_connect("localhost","root","","jourya");

        $requete = "SELECT * FROM customer WHERE cus_id = $cus_id";
        $stmt = mysqli_query($conn, $requete);
        

    if (mysqli_num_rows($stmt) === 0) {
        return null; 
    } else {
        $cusData = mysqli_fetch_assoc($stmt);
        
        // Mettre à jour les attributs de l'objet Product avec les détails du produit
        $this->cus_username = $cusData['cus_username'];
        $this->cus_firstName = $cusData['cus_firstname'];
        $this->cus_lastName = $cusData['cus_lastname'];
        $this->cus_address = $cusData['cus_adr'];
        $this->cus_tel = $cusData['cus_tel'];
        $this->cus_email = $cusData['cus_email'];
        $this->cus_password = $cusData['cus_password'];
        $this->cus_admin = $cusData['cus_admin'];
        
        mysqli_close($conn); 
        return $this; 
    }
}

        public function getAllCustomer() {
            include("ConnexionBD.php");
            $cus_id = $_SESSION['user_id'];
            
            $requete = "SELECT * FROM customer  ";
            $result = mysqli_query($conn,$requete);
        /* 
            if (mysqli_num_rows($result) == 0) {
                return null; 
            } else { */
                $items = array(); // Tableau pour stocker les Product
        
                // Parcourir les résultats de la requête et créer des objets Product pour chaque produit
                while ($itemData = mysqli_fetch_assoc($result)) {
                    $item = new Customer("", "", "", "","", "", "", "", "");//Pas besoin de mettre les arguments   Je pense
                    
                    $item->setCusId($itemData['cus_id']);
                    $item->setCusEmail($itemData['cus_email']);
                    $item->setCusUsername($itemData['cus_username']);
                    $item->setCusLastName($itemData['cus_lastname']);
                    $item->setCusFirstName($itemData['cus_firstname']);
                    $item->setCusTel($itemData['cus_tel']);
                    $item->setCusAddress($itemData['cus_adr']);
                    $item->setCusAdmin($itemData['cus_admin']);
                    

                    
                    $items[] = $item; // Ajouter l'objet Product au tableau des produits
                }
        
                return $items; // Retourner le tableau d'objets Product
            }
        
}
   