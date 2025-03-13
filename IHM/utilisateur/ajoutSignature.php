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
                <form action="/Traitement/Utilisateurs.php" method="post">
                    <input type="number" name="idp" value="<?php echo $petition['IDP'] ?>" hidden>
                    <label for="titre">Titre:</label>
                    <input type="text" name="titre" id="titre" placeholder="Titre de la pétition" required>
        
                    <label for="nom">Nom:</label>
                    <input type="text" name="nom" id="nom" placeholder="Votre nom" required>

                    <label for="prenom">Prénom:</label>
                    <input type="text" name="prenom" id="prenom" placeholder="Votre prenom" required>
        
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" placeholder="Votre email" required>
        
                    <label for="pays">Pays:</label>
                    <input type="text" name="pays" id="pays" placeholder="Votre pays" required>
                    
                    <button type="submit" name="sendAjoutSignature">Envoyer</button>
                </form>
        
                <img src="/IHM/utilisateur/static/image/petition_form.jpg" alt="image pétition">
            </div>

            <?php
                if(isset($fiveLastSignatures) && !empty($fiveLastSignatures)){
                    echo "<p>Signée par:</p>";
            ?>
            <div class="fiveSign">  

            <?php
                    foreach($fiveLastSignatures as $signature){
                        // print_r($signature)
            ?>
                <div class="signContainer">
                    <span><?php echo $signature['Nom'].' '.$signature['Prenom'] ?></span>
                    <span><?php echo $signature['Pays'] ?></span>
                </div>

            <?php
                    }
                }
                else
                    echo "Pétition n'a aucune signature"
            ?>
                
            </div>
        </div>
    </section>
</body>
</html>