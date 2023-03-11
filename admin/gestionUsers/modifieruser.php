<?php
include 'includes/header.php';
include 'includes/footer.php';
// Database connection information
$servername = "mysql-devoperationnel.alwaysdata.net";
$username = "300812";
$password = "devops123456";
$dbname = "devoperationnel_projet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Retrieve existing user by id
$id = $_GET['id']; // assuming the ID is passed in the URL as a GET parameter

// validate the ID to make sure it's a positive integer
if (!ctype_digit($id) || $id <= 0) {
    // handle invalid ID error
}

$query1 = "SELECT * FROM Utilisateurs WHERE id = $id";
$result1 = mysqli_query($conn, $query1);

if ($result1) {
    $user = mysqli_fetch_assoc($result1);
    // do something with the user data
} else {
    // handle query error
}


// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = $_POST["email"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $roleUser = $_POST["roleUser"];

    // Prepare SQL statement to update user data
    $sql = "UPDATE Utilisateurs SET email='$email', nom='$nom', prenom='$prenom', roleUser='$roleUser' WHERE id='$id'";

    // Execute SQL statement
   if ($conn->query($sql) === TRUE) {
    echo "<script>toastr.success('Modification effectuée..!')</script>";
    exit(header("Location: listeUsers.php")); // redirect to index page
    } else {
    echo "Error updating user: " . $conn->error;
    }
}

// Close database connection
$conn->close();
?>

<div class="back-btn">
    <a href="javascript:history.go(-1)">
        « Retour
    </a>
</div>

<div class="modifierForm">
    <form action="" method="post">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@esp\.sn$" value="<?= $user['email'] ?>"><br>

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?= $user['nom']?>"><br>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" value="<?= $user['prenom']?>"><br>

        <label for="roleUser">Rôle :</label>
        <input type="text" id="roleUser" name="roleUser" value="<?= $user['roleUser']?>"><br>
        <input type="submit" name="modifier" value="Modifier">
    </form>
</div>