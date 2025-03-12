<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Petition/IHM/utilisateur/static/style.css">
    <title>Acceuil</title>
</head>
<body>
    <!-- inclusion header -->

    <?php include('include/header.php') ?>

    <section class="main_container">
        <div class="container">
            <p class="hero">
                <span>Votre voix a le pouvoir de changer le monde.</span> <br>  <br>
                Signez pour faire la différence !
            </p>
            <div class="btnContainer">
                <a href="ajouterPetition.php">Nouvelle Pétition</a>
                <a href="listePetition.php">Liste Pétition</a>
            </div>
        </div>
    </section>

    <hr>

    <!-- form for adding new petition -->
     <?php include('ajouterPetition.php'); ?>


</body>
</html>