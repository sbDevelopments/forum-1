<?php

session_start();

$titre = 'Enregistrement';

include('includes/identifiants.php');
include('includes/debut.php');
include('includes/menu.php');

echo '<p><i>Vous êtes ici </i> : <a href="./index.php">Index du forum </a> --> Enregistrement';
$id=0;
if ($id!=0) erreur(ERR_IS_CO);


//si $_POST['pseudo'] n'est pas encore défini alors on affiche le formulaire d'inscription.

if(empty($_POST['pseudo']))
{
    ?>
    <h1>Inscription 1/2</h1>;
    <form method="post" action="register.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Identifiants</legend>
            <label for="pseudo">* Pseudo :</label>
            <input name="pseudo" type="text" id="pseudo" /> (le pseudo doit contenir entre 3 et 15 caractères)
            <br />
            <label for="password">* Mot de Passe :</label>
            <input type="password" name="password" id="password" />
            <br />
            <label for="confirm">* Confirmer le mot de passe :</label>
            <input type="password" name="confirm" id="confirm" />
        </fieldset>
        <fieldset>
            <legend>Contacts</legend>
            <label for="email">* Votre adresse Mail :</label>
            <input type="text" name="email" id="email" />
            <br />
            <label for="msn">Votre adresse MSN :</label>
            <input type="text" name="msn" id="msn" />
            <br />
            <label for="website">Votre site web :</label>
            <input type="text" name="website" id="website" />
        </fieldset>
        <fieldset>
            <legend>Informations supplémentaires</legend>
            <label for="localisation">Localisation :</label>
            <input type="text" name="localisation" id="localisation" />
        </fieldset>
        <fieldset>
            <legend>Profil sur le forum</legend>
            <label for="avatar">Choisissez votre avatar :</label>
            <input type="file" name="avatar" id="avatar" />(Taille max : 10Ko
            <br />
            <label for="signature">Signature :</label>
            <textarea cols="40" rows="4" name="signature" id="signature">La signature est limitée à 200 caractères</textarea>
        </fieldset>
        <p>Les champs précédés d un * sont obligatoires</p>
        <p>
            <input type="submit" value="S'inscrire" />
        </p>
    </form>
    </div>
    </body>

    </html>

    <?php
}

//traitement de la requête
else
{
    $pseudo_erreur1 = NULL;
    $pseudo_erreur2 = NULL;
    $mdp_erreur = NULL;
    $email_erreur1 = NULL;
    $email_erreur2 = NULL;
    $msn_erreur = NULL;
    $signature_erreur = NULL;
    $avatar_erreur = NULL;
    $avatar_erreur1 = NULL;
    $avatar_erreur2 = NULL;
    $avatar_erreur3 = NULL;


    $compteur_erreurs = 0;
    $temps = time();
    $pseudo = $_POST['pseudo'];
    $signature = $_POST['signature'];
    $email = $_POST['email'];
    $msn = $_POST['msn'];
    $website = $_POST['website'];
    $localisation = $_POST['localisation'];
    $pass = md5($_POST['password']);
    $confirm = md5($_POST['confirm']);

    //vérification du pseudo
    $query = $db -> prepare(
        'SELECT COUNT(*) AS nbr FROM forum_membres WHERE membre_pseudo= :pseudo');
        $query-> bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $query->execute();
        $pseudo_free = ($query->fetchColumn()==0)?1:0;
        $query->closeCursor();
    //vérification de la disponibilité du pseudo
    if(!pseudo_free)
    {
        $pseudo_erreur1 = "Ce pseudo est déjà utilisé";
        $i++;
    }

    //vérification de la taille du pseudo
    if(strlen($pseudo)<3 || strlen($pseudo)>15)
    {
        $pseudo2 = "Le pseudo doit contenir au moins 3 caractères et pas plus de 15";
        $i++;
    }

    //vérification du mot de passe
    if(($pass != $confirm) || empty($confirm) || empty($pass))
    {
        $mdp_erreur="Le mot de passe et la confirmation sont différents ou sont vides.";
    }

}

?>
