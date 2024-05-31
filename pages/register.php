<?php if (isset($_COOKIE['id'])) {
    header('Location: ./discussions.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>D-Send</title>
</head>
<body>
    <?php require_once ("../includes/menubar.php") ?>

    <div class="auth-cover-form">
        <form action="/dsend/processing/authentification.php" method="post">

            <h1 class="text-center">S'inscrire</h1>

            <p class="text-center">Renseignez les informations liées au compte que vous êtes sur le point de créer.</p>

            <?php if (isset($_GET['email']) && $_GET['email'] == "error") { ?>
                <div class="alert-error">
                    Email invalide ou déjà utiliser
                </div>
            <?php } ?>

            <?php if (isset($_GET['password']) && $_GET['password'] == "error") { ?>
                <div class="alert-error">
                    Les deux mots de passe saisis ne sont pas identiques
                </div>
            <?php } ?>

            <input type="hidden" name="source" value="register">

            <label for="email">E-mail</label>
            <input type="email" placeholder="Saisir l'e-mail ici ..." id="email" name="email" require minlength="6" maxlength="50">
            <br /><br />

            <label for="password">Mot de passe</label>
            <input type="password" placeholder="Saisir le mot de passe ici ..." id="password" name="password" require minlength="6" maxlength="50">
            <br /><br />

            <label for="confrm_password">confirmer mot de passe</label>
            <input type="password" placeholder="Confirmer le mot de passe ici ..." id="confrm_password" name="confrm_password" require minlength="6" maxlength="50">
            <br /><br />

            <button class="button w-100">
                S'inscrire
            </button>

            <p>
                Déjà inscrit(e), <a href="/dsend">Connectez-vous</a>
            </p>
        </form> 
    </div>
</body>

</html>