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

// Retrieve existing tickets from database
$query1 = "SELECT * FROM Tickets";
$result1 = mysqli_query($conn, $query1);
$tickets = mysqli_fetch_all($result1, MYSQLI_ASSOC);

if (isset($_POST['changerEtat'])) {
    //Validate and sanitize user input
    $id = filter_var($_POST['ticketId']); 
    $etat = filter_var($_POST['etat']); 

    //Prepare and bind the SQL statement
    $stmt = $conn->prepare("UPDATE Tickets SET etat=? WHERE id=?");
    $stmt->bind_param("si", $etat, $id);

    //Execute the SQL statement and handle any errors
    if ($stmt->execute()) {
        //Ticket state updated successfully
        //Redirect the user to a success page
        header("Location: listTickets.php");
        exit();
    } else {
        //An error occurred while updating the ticket state
        //Log the error and display an error message to the user
        error_log("Error updating ticket state: " . $conn->error);
        $errorMessage = "An error occurred while updating the ticket state. Please try again later.";
    }
}

?>
<br>
<h2 style="text-align: center; color:darkslategrey;">Liste des tickets</h2>
<br>
<!-- Ticket list table -->
<table style="width: 90%;">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Type</th>
            <th>Date de Création</th>
            <th>Client</th>
            <th>Assigné a</th>
            <th>Etat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tickets as $ticket) : ?>
            <tr>
                <td><?= $ticket['titre'] ?></td>
                <td><?= $ticket['typeTkt'] ?></td>
                <td><?= $ticket['dateCreation'] ?></td>
                <td><?= $ticket['email'] ?></td>
                <td><?= $ticket['adminTkt'] ?></td>
                <td
                class="<?php
				switch($ticket['etat']) {
					case 'REÇU': echo 'etat-recu'; break;
					case 'EN COURS': echo 'etat-en-cours'; break;
					case 'EN ATTENTE': echo 'etat-en-attente'; break;
					case 'NE PAS TRAITER': echo 'etat-non-traite'; break;
					case 'TERMINÉ': echo 'etat-termine'; break;
					case 'CLÔTURÉ': echo 'etat-cloture'; break;
				}
			?>"
                ><?= $ticket['etat'] ?></td>
                <td>
                    <div class="actions">
                        <a href="#" onclick="toggleForm(<?= $ticket['id'] ?>)" class="actionButton" id="changeState" style="margin-left: 50px;">Changer État</a>                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<form id="stateForm" style="display:none;" method="post">
    <input type="hidden" name="ticketId" id="ticketId" value="">
    <label for="etat">État :</label>
    <select name="etat" id="etat">
        <option selected disabled> Changer l'état du ticket </option>
        <option value="REÇU">REÇU</option>
        <option value="EN COURS">EN COURS</option>
        <option value="EN ATTENTE">EN ATTENTE</option>
        <option value="NE PAS TRAITER">NE PAS TRAITER</option>
        <option value="TERMINÉ">TERMINÉ</option>
        <option value="CLÔTURÉ">CLÔTURÉ</option>
    </select>

    <div class="form-buttons">
        <button type="submit" name="changerEtat">Enregistrer</button>
        <button type="button" onclick="closeForm()">Annuler</button>
    </div>
</form>

<form id="assignerTicket" style="display:none;" method="post">
    <input type="hidden" name="ticketIdAssign" id="ticketIdAssign" value="">
    <label for="technicien">Assigner le ticket à :</label>
    <select name="technicien" id="technicien">
        <option selected disabled> Assigner le ticket à un technicien </option>
        <?php
        $query = "SELECT * FROM Utilisateurs WHERE roleUser = 'equipe'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['email'] . '"> ' . $row['email'] . '</option>';
        }
        ?>
    </select>
    <div class="form-buttons">
        <button type="submit" name="assignerTicket">Enregistrer</button>
        <button type="button" onclick="closeForm()">Annuler</button>
    </div>
</form>
