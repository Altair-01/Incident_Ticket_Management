<?php
include 'includes/header.php';
include 'includes/footer.php';

session_start();
$email = $_SESSION['email'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection information
$servername = "mysql-devoperationnel.alwaysdata.net";
$username = "300812";
$password = "devops123456";
$dbname = "devoperationnel_projet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Handle form submission
if (isset($_POST['creer'])) {
    $titre = $_POST['titre'];
    $type = $_POST['type'];
    $description = $_POST['description'];
    $priorite = $_POST['priorite'];


    // Insert new user into database
    $stmt = $conn->prepare("INSERT INTO Tickets (typeTkt, descriptionTkt, titre, email, priorite, dateCreation) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $type, $description, $titre, $email, $priorite);
    $stmt->execute();

    if($stmt->affected_rows > 0){
        //Success message
        echo "Le nouvel utilisateur a été ajouté avec succès !";
    } else{
        //Error message
        echo "Une erreur s'est produite lors de l'ajout du nouvel utilisateur.";
    }
    
    // Redirection vers la page user.php
    header("Location: user.php");
    exit();

    
    // Redirect to user list page
    header('Location: user.php');
    exit();
}
?>

<br>
<h3 style="text-align: center; color:chocolate;">Création d'un ticket d'incident</h3>
<br>
<div style="width: 70%;" class="container">
    <form style="width: 100%;" class="box" action="" method="post" name="login">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" class="form-control" name="titre" placeholder="Objet du ticket" required>
        </div>

        <div class="form-group">
            <label for="type">Type :</label>
            <select class="form-control" name="type" required>
                <option selected disabled hidden>Sélectionnez un type d'incident</option>
                <option value="informatique">Problèmes informatiques</option>
                <option value="securite">Problèmes de sécurité</option>
                <option value="reseau">Problèmes de réseau</option>
                <option value="logistique">Problème logistique</option>
                <option value="communication">Problèmes de communication</option>
                <option value="maintenance">Problèmes de maintenance</option>
                <option value="autre">Autre problème</option>
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description :</label>
            <br>
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Description du ticket" required></textarea>
        </div>

        <div class="form-group">
            <label for="priorite">Priorité:</label>
            <select class="form-control" name="priorite" required>
                <option selected disabled hidden>Sélectionnez une priorité</option>
                <option value="haute">Haute</option>
                <option value="critique">Critique</option>
                <option value="moyenne">Moyenne</option>
                <option value="basse">Basse</option>
            </select>
        </div>

        <!-- <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" class="form-control" name="email" placeholder="email" required pattern="[a-zA-Z0-9._%+-]+@esp\.sn$">
        </div> -->
        <input type="submit" value="Créer" name="creer" class="btn btn-primary">
    </form>
</div>

<div style="height: 100px;"></div>