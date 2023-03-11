<?php
include 'includes/header.php';
include 'includes/footer.php';
session_start();
?>
<div class="containerActions">
            <div class="choixAction">
                <img class="action" src="../images/personnaliser.png"> &nbsp;&nbsp;
                <a href="createTicket.php"><p class="descAction">Ajouter un ticket d'incident</p></a>
            </div>
            <div class="choixAction">
                <img class="action" src="../images/ticket.png"> &nbsp;&nbsp;
               <a href="listMyTickets.php"><p class="descAction">L'évolution de mes tickets</p></a>
            </div>
</div>

<footer>
        <p>Copyright © 2023 GestionTickets</p>
    </footer>
</body>
</html>