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
                <form class="petition" action="/Traitement/Utilisateurs.php" method="post">
                    <input type="number" name="idp" hidden value="<?php echo $petition['IDP'] ?>">
                <!-- <div > -->
                    <div class="action">
                        <button type="submit" name="sendEditPetition" class="check-btn" style="display: none;">
                            <!-- <a href="/Traitement/Utilisateurs.php?editPetition=editPetition&idp=<?php //echo $petition['IDP'] ?>"> -->
                                <img src="/IHM/utilisateur/static/image/check.png" alt="edit">
                            <!-- </a> -->
                        </button>
                        <a class="edit-btn">
                            <img src="/IHM/utilisateur/static/image/edit.svg" alt="edit">
                        </a>
                        <!-- <button> -->
                            <a href="/Traitement/Utilisateurs.php?deletePetition=deletePetition&idp=<?php echo $petition['IDP'] ?>">
                                <img src="/IHM/utilisateur/static/image/delete-button.svg" alt="edit">
                            </a>
                        <!-- </button> -->
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
                        <label>:</label>
                        <input type="text" name="email" value="<?php echo $petition["Email"] ?>" readonly>
                        <label for="datePublic">, le </label>
                        <input type="date" name="datePublic" id="datePublic" value="<?php echo $petition["DatePublic"] ?>" readonly>
                    </span>

                    <a href="/Traitement/Utilisateurs.php?ajoutSignature=ajoutSignature&idp=<?php echo $petition['IDP'] ?>" >Signer</a>
                <!-- </div> -->

                </form>
            </div>

            <?php
                    }
                }else
                    echo "aucune pétition...";
                
            ?>
        </div>
    </section>

    <?php include('include/footer.php') ?>
    
    <script src="/IHM/utilisateur/static/script.js"></script>
</body>
</html>