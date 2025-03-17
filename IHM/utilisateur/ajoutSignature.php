<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/IHM/utilisateur/static/style.css">
    <title>Ajout Signature</title>
</head>
<body>
    <?php include('include/header.php'); ?>

    <section>
        <div class="container">
            <p class="petition_p">
                <span><?php echo $petition['Titre'] ?></span> <br> <br>
                Par <?php echo $petition['PorteurP'] ?>
            </p>

            <div class="formContainer">
                <form id="signatureForm" action="/Traitement/Utilisateurs.php" method="post">
                    <input type="hidden" name="idp" value="<?php echo $petition['IDP'] ?>">
                    <input type="hidden" name="ids" id="ids"> <!-- ID de la signature (utilisé en mode édition) -->

                    <label for="titre">Titre:</label>
                    <input type="text" name="titre" id="titre" placeholder="Titre de la pétition" value="<?php echo $petition['Titre'] ?>" readonly required>
        
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" placeholder="Votre nom" required>

                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Votre prénom" required>
        
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Votre email" required oninput="validateEmail()">
                    <small id="emailError" style="color: red; display: none;">Veuillez entrer une adresse email valide.</small>
        
                    <label for="pays">Pays:</label>
                    <input type="text" name="pays" id="pays" placeholder="Votre pays" required>
                    
                    <button type="submit" name="sendAjoutSignature" id="btn-submit">Envoyer</button>
                </form>
        
                <img src="/IHM/utilisateur/static/image/petition_form.jpg" alt="image pétition">
            </div>                

            <p>Signée par :</p>
            <div class="fiveSign">
                <!-- Les signatures seront ajoutées ici par AJAX -->
            </div>

        </div>
    </section>

    <?php include('include/footer.php'); ?>

    <script src="/IHM/utilisateur/static/script.js"></script>
</body>
</html>
