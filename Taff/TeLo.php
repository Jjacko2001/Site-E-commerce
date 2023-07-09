<?php
session_start(); 
// Vérifier si l'utilisateur est déjà connecté, le rediriger vers la page d'accueil
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

// Vérifier si le formulaire de connexion a été soumis
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
        $query = "SELECT cus_id, cus_username, cus_password FROM customer WHERE cus_username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                $user_id = $row['cus_id'];
                $hashed_password = $row['cus_password'];

                // Vérifier le mot de passe
                // if (password_verify($password, $hashed_password))
                if ($password == $hashed_password) {
                    // Mot de passe correct, création de la session de connexion
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;

                    // Redirection vers la page d'accueil
                    header('Location: index.php');
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style type="text/css">
    body {
        margin:0px;
        padding:0px;
        font-family: sans-serif;
        font-size:.9em;
    }
    div {
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
        -ms-transform: translate(-50%,-50%);
        -moz-transform: translate(-50%,-50%);
        -webkit-transform: translate(-50%,-50%);
        position:absolute;
        width:350px;
        background:#eee;
        padding:10px 20px;
        border-radius: 2px;
        box-shadow:0px 0px 10px #aaa;
        box-sizing:border-box;
    }
    input {
        display: inline-block;
        border: none;
        width:100%;
        border-radius:2px;
        margin:5px 0px;
        padding:7px;
        box-sizing: border-box;
        box-shadow: 0px 0px 2px #ccc;
    }
    #submit {
        border:none;
        background-color: blue;
        color:white;
        font-size:1em;
        box-shadow: 0px 0px 3px #777;
        padding:10px 0px;
    }
    span {
        color:red;
        font-size: 0.75em;
    }
    p {
        text-align: center;
        font-size: 1.75em;
    }
    a {
        text-decoration: none;
        color:blue;
        font-weight: bold;
    }
</style>

</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>Login</p>
        <?php 
        echo 'Username<br><input type="text" name="uname" placeholder="Username"><br>';
        echo '<br>Password<br><input type="password" name="pass" placeholder="Password"><br>';
        if (!empty($login_err) && $login_err) {
            echo "<span>Incorrect Username or password.</span>";
        }
        if (!empty($empty_fields) && $empty_fields) {
            echo "<span>Enter username and password.</span>";
        }
        ?>
        <br>
        <input type="submit" id="submit" value="Login"><br><br>
        Don't have an account? <a href="signup.php">SignUp</a>.<br><br>
    </form>
</body>
</html>
