<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/IHM/utilisateur/static/style.css">
    <title>Liste des Pétitions</title>
</head>
<body>

    <?php include('include/header.php'); ?>

    <section>
        <div class="container">
            <p class="petition_p">
            <span>Chaque signature compte.</span> <br> <br>
            Soutenez les causes qui vous tiennent à coeur !
            </p>
    
            <?php
                if(isset($petitions) && !empty($petitions)){

                foreach($petitions as $petition){   
            ?>

            <div class="petitionContainer">
                <div class="petition">
                    <div class="action">
                        <button><img src="/IHM/utilisateur/static/image/edit.svg" alt="edit"></button>
                        <button><a href="/Traitement/Utilisateurs.php?deletePetition=deletePetition&idp=<?php echo $petition['IDP'] ?>"><img src="/IHM/utilisateur/static/image/delete-button.svg" alt="edit"></a></button>
                    </div>

                    <div class="petitionHeader">
                        <input type="text" name="titre" value="<?php echo $petition['Titre'] ?>" readonly>
                        <span>
                            <label for="dateFinP">Date limite: </label>
                            <input type="date" name="dateFinP" id="dateFinP" value="<?php echo $petition["DateFinP"] ?>" readonly>
                        </span>
                    </div>

                    <textarea name="description" id="description" readonly><?php echo $petition["Description"] ?></textarea>

                    <span class="info">
                        <label for="porteurP">Par </label>
                        <input type="text" name="porteurP" id="porteurP" value="<?php echo $petition["PorteurP"] ?>" readonly>
                        <input type="text" name="email" value="<?php echo "(".$petition["Email"].")" ?>" readonly>
                        <label for="datePublic">, le </label>
                        <input type="date" name="datePublic" id="datePublic" value="<?php echo $petition["DatePublic"] ?>" readonly>
                    </span>

                    <a href="/Traitement/Utilisateurs.php?ajoutSignature=ajoutSignature&idp=<?php echo $petition['IDP'] ?>" >Signer</a>
                </div>
            </div>

            <?php
                    }
                }else
                    echo "aucune pétition...";
                
            ?>
        </div>
    </section>
    
</body>
</html>