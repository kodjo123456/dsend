<?php if (isset($_COOKIE['id'])) {
    header('Location: ./pages/discussions.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D-Send</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <?php require_once ("./includes/menubar.php") ?>
    
    <div class="auth-cover-form">
        <form action="/dsend/processing/authentification.php" method="post">

            <h1 class="text-center">Se connecter</h1>

            <p class="text-center">Renseignez vos paramètres de connection dans les champs pour vous connecter à votre compte.</p>

            <?php if (isset($_GET['auth']) && $_GET['auth'] == "error") { ?>
                <div class="alert-error">
                L'adresse e-mail ou le mot de passe que vous avez saisis ne sont pas valides.
                </div>
          <?php  } ?>

          <label for="email">E-mail</label>
          <input type="email" placeholder="Saisir l'e-mail ici ..." id="email" name="email" require minlength="6" maxlength="50">
          <br /><br />

          <input type="hidden" name="source" value="login">

          <label for="password">Mot de passe</label>
          <input type="password" placeholder="Saisir le mot de passe ici ..." id="password" name="password" require minlength="6" maxlength="50">
          <br /><br />

          <button>
            Se connecter
          </button>

          <p>
            Pas encore de compte, <a href="/dsend/pages/register.php">inscrivez-vous.</a>
          </p>

        </form>
    </div>

</body>

</html>