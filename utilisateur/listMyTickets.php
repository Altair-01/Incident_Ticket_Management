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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve existing users from database
$query1 = "SELECT * FROM Tickets where email = '$email'";
$result1 = mysqli_query($conn, $query1);
$tickets = mysqli_fetch_all($result1, MYSQLI_ASSOC);
?>
<br>
<h2 style="text-align: center; color:darkslategrey;">Mes Tickets</h2>
<br>
<!-- User list table -->
<table>
	<thead>
		<tr>
			<th>Titre</th>
            <th>Type</th>
			<th>Date de Création</th>
            <th>Etat</th>
			<!-- <th colspan="2">Action</th> -->
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tickets as $ticket) : ?>
			<tr class="<?php
				switch($ticket['etat']) {
					case 'REÇU': echo 'etat-recu'; break;
					case 'EN COURS': echo 'etat-en-cours'; break;
					case 'EN ATTENTE': echo 'etat-en-attente'; break;
					case 'NE PAS TRAITER': echo 'etat-non-traite'; break;
					case 'TERMINÉ': echo 'etat-termine'; break;
					case 'CLÔTURÉ': echo 'etat-cloture'; break;
				}
			?>">
				<td><?= $ticket['titre'] ?></td>
				<td><?= $ticket['typeTkt'] ?></td>
				<td><?= $ticket['dateCreation'] ?></td>
				<td><?= $ticket['etat'] ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
