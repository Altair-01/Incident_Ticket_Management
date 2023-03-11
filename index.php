<?php
//Connect to the MySQL database
$conn = mysqli_connect('mysql-devoperationnel.alwaysdata.net', '300812', 'devops123456', 'devoperationnel_projet');

//Check if the form has been submitted
if (isset($_POST['submit'])) {

  //Retrieve the values entered in the form
  $identifiant = mysqli_real_escape_string($conn, $_POST['identifiant']);
  $mdp = mysqli_real_escape_string($conn, $_POST['mdp']);

  //Query the database to check if the user exists and their password is correct
  $query1 = "SELECT * FROM Utilisateurs WHERE email=? AND motdepasse=?";
  $query2 = "SELECT * FROM Administrateur WHERE email=? AND motdepasse=?";

  $stmt1 = mysqli_prepare($conn, $query1);
  $stmt2 = mysqli_prepare($conn, $query2);

  mysqli_stmt_bind_param($stmt1, "ss", $identifiant, $mdp);
  mysqli_stmt_execute($stmt1);
  $result1 = mysqli_stmt_get_result($stmt1);

  mysqli_stmt_bind_param($stmt2, "ss", $identifiant, $mdp);
  mysqli_stmt_execute($stmt2);
  $result2 = mysqli_stmt_get_result($stmt2);

  if (mysqli_num_rows($result1) == 1) {
    // Start a session and set the session variable
    session_start();
    $_SESSION['logged_in'] = true;
  
    $row1 = mysqli_fetch_assoc($result1);
    $_SESSION['email'] = $row1['email'];
    if ($row1['roleUser'] == 'client') {
      header('Location: utilisateur/user.php');
    } else if ($row1['roleUser'] == 'equipe') {
      // redirect to a different page based on the user's role
      header('Location: equipe/gestionTickets/listTickets.php');
    }
  } elseif (mysqli_num_rows($result2) == 1) {
    // Start a session and set the session variable
    session_start();
    $row2 = mysqli_fetch_assoc($result2);
    $_SESSION['logged_in'] = true;
    $_SESSION['email'] = $row2['email'];
    header('Location: admin/admin.php');
  } else {
    //Handle errors
    error_log(mysqli_error($conn));
    // Display a generic error message to the user on the same page
    echo '<p style="color:red;">Vos identifiants sont incorrects</p>';
  }
  
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Gestion des tickets d'incident</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="script.js"></script>
</head>

<body>
  <nav>
    <!-- <div id="logodiv">
            <img id="logo" src="images/logo1.png">
        </div> -->
    <div>
      <ul>
        <li><a href="informations.php">Informations</a></li>
        <li><a href="index.php">Accueil</a></li>
      </ul>
    </div>
  </nav>


  <form method="post" class="form-width">
    <div class="imgcontainer">
      <img src="images/billet.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <div class="form-group">
        <label for="identifiant"><b>Adresse Mail</b></label>
        <input type="email" class="form-control" id="identifiant" placeholder="Adresse Mail" name="identifiant" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
      </div>


      <div class="form-group">
        <label for="mdp"><b>Mot de passe</b></label>
        <input type="password" class="form-control" id="mdp" placeholder="Mot de passe" name="mdp" required>
      </div>

      <button type="submit" class="btn btn-primary" name="submit">Login</button>
    </div>
  </form>

  <footer>
    <p>Copyright © 2023 GestionTickets</p>
  </footer>
</body>

</html>