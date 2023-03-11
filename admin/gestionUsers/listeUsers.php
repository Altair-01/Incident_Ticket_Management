<?php
include 'includes/header.php';
include 'includes/footer.php';

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
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$roleUser = $_POST['roleUser'];
	$mdp = $_POST['mdp'];

	// Insert new user into database
	$query = "INSERT INTO Utilisateurs (email, nom, prenom, roleUser, motdepasse) VALUES ('$email', '$nom', '$prenom', '$roleUser', '$mdp')";
	mysqli_query($conn, $query);

	// Redirect to user list page
	header('Location: listeUsers.php');
	exit();
}

// Retrieve existing users from database
$query1 = "SELECT * FROM Utilisateurs";
$result1 = mysqli_query($conn, $query1);
$utilisateurs = mysqli_fetch_all($result1, MYSQLI_ASSOC);
?>

<!-- Add user form -->
<div id="myModal" class="modal">
	<div class="modal-content">
		<!-- Your modal content goes here -->
		<span class="close">&times;</span>
		<form action="" method="post">

			<label for="email">Email :</label>
			<input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@esp\.sn$"><br>

			<label for="nom">Nom :</label>
			<input type="text" id="nom" name="nom"><br>

			<label for="prenom">Prénom :</label>
			<input type="text" id="prenom" name="prenom"><br>

			<label for="roleUser">Rôle :</label>
			<input type="text" id="roleUser" name="roleUser"><br>

			<label for="mdp">Mot de passe :</label>
			<input type="password" id="mdp" name="mdp" required><br>

			<input type="submit" name="submit" value="Ajouter">
		</form>
	</div>
</div>
<h2 style="text-align: center; color:darkslategrey;">Gestion des utilisateurs</h2>
<button class="addButton" onclick="showForm()">Ajouter un utilisateur</button>

<!-- User list table -->
<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Email</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Rôle</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($utilisateurs as $utilisateur) : ?>
			<tr>
				<td><?= $utilisateur['id'] ?></td>
				<td><?= $utilisateur['email'] ?></td>
				<td><?= $utilisateur['nom'] ?></td>
				<td><?= $utilisateur['prenom'] ?></td>
				<td><?= $utilisateur['roleUser'] ?></td>
				<td>
					<div class="actions">
						<a href="modifierUser.php?id=<?= $utilisateur['id'] ?>" class="actionButton" id="modifierButton">Edit</a>
						<a href="deleteUser.php?id=<?= $utilisateur['id'] ?>" onclick="return confirmSuppression()" class="actionButton" id="deleteButton">Delete</a>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<footer>
	<p>Copyright © 2023 GestionTickets</p>
</footer>
</body>

</html>