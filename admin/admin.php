<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestion des tickets d'incident</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../script.js"></script>
</head>

<body>
    <nav>
        <!-- <div id="logodiv">
            <img id="logo" src="images/logo1.png">
        </div> -->
        <div>
            <ul>
            <div id="logoutdiv">
                    <a id="logoutLink" href="../logout.php?logout"><img id="logout" src="../images/se-deconnecter.png"></a>
                </div>
                <li><a href="informations.php">Informations</a></li>
                <li><a href="index.php">Accueil</a></li>
            </ul>
        </div>
    </nav>


    <div class="containerActions">
        <div class="choixAction">
            <img class="action" src="../images/personnaliser.png"> &nbsp;&nbsp;
            <a href="gestionUsers/listeUsers.php">
                <p class="descAction">Gestion des utilisateurs</p>
            </a>
        </div>
        <div class="choixAction">
            <img class="action" src="../images/ticket.png"> &nbsp;&nbsp;
            <a href="gestionTickets/listTickets.php">
                <p class="descAction">Gestion des tickets</p>
            </a>
        </div>
    </div>

    <footer>
        <p>Copyright © 2023 GestionTickets</p>
    </footer>
</body>

</html>