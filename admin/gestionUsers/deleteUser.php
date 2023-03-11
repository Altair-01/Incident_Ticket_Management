<?php
// Check if the delete link was clicked and the ID parameter is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Connect to the database
    $conn = mysqli_connect('mysql-devoperationnel.alwaysdata.net', '300812', 'devops123456', 'devoperationnel_projet');

    // Prepare the query using a placeholder
    $query = "DELETE FROM Utilisateurs WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter to the placeholder
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the prepared statement
    mysqli_stmt_execute($stmt);

    // Close the statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // Redirect to the user list page
    header('Location: listeUsers.php');
    exit();
}
?>