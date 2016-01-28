<?php
session_start();
session_destroy();
$titre="Déconnexion";

include("includes/debut.php");
include("includes/menu.php");

if($i==0) erreur(ERR_IS_NOT_CO);
?>

    <p>Vous êtes à présent déconnecté
        <br /> Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a> pour revenir à la page précédente.
        <br /> Cliquez <a href="./index.php">ici</a> pour revenir à la page principale</p>
    </div>
    </body>

    </html>
