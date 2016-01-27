<?php
session_start();

$titre = 'Page de connexion';

include("includes/identifiants.php");
include("includes/debut.php");
include("includes/menu.php");


echo '<h1>Connexion</h1>';
//Traitement de la sécurité - la page ne s'affiche que si l'utilisateur à un $id

if ($id!=0) erreur(ERR_IS_CO);


//Affichage du formulaire d'inscription
if (!isset($_POST['pseudo']))
{
?>

    <form method="POST" action="connexion.php">
        <fieldset>
            <legend>Connexion</legend>
            <p>
                <label for="pseudo">Pseudo : </label>
                <input type="text" name="pseudo" id="pseudo" />
                <br />
                <label for="password">Mot de passe : </label>
                <input type="password" name="password" id="password" />
            </p>
        </fieldset>
        <p>
            <input type="submit" value="Connexion" />
        </p>
    </form>
    <a href="./register.php">Inscrivez-vous !</a>

    </div>
    </body>

    </html>


    <?php
}
//Traitement de la requête
else
{
    $message='';
    if (empty($_POST['pseudo']) || empty($_POST['password']))
    {
    $message='<p> une erreur s\'est produite pendant votre identification, vous devez remplir tous les champs. </p>
    <p>Cliquez <a href="./connexion.php">ici </a> pour revenir </p>';
    }

    else
    {//on vérifie le mot de passe
        $query = $bd -> prepare('SELECT membre_mdp, membre_id, membre_rang, membre_pseudo FROM forum_membres WHERE membre_pseudo = :pseudo');
        $query->bindValue(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch();
    }

    if (($data['membre_mdp']) == md5($_POST['password']))
    {
        $_SESSION['pseudo'] =$data['membre_pseudo'];
        $_SESSION['level'] = $data['membre_rang'];
        $_SESSION['id'] = $data['membre_id'];
        $message='<p>Bienvenue '.$data['membre_pseudo']. ' vous êtes maintenant connecté </p> <p> Cliquez <a href="./index.php">ici</a> pour revenir à l\'accueil';
    }

}
		?>
