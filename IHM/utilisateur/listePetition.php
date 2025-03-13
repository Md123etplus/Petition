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
            <p>
                Chaque signature compte. <br> <br>
                <span>Soutenez les causes qui vous tiennent à cœur !</span>
            </p>
    
            <div class="petitionContainer">
                <div class="petition">
                    <div class="action">
                        <button><img src="/IHM/utilisateur/static/image/edit.svg" alt="edit"></button>
                        <button><img src="/IHM/utilisateur/static/image/delete.svg" alt="edit"></button>
                    </div>

                    <div class="petitionHeader">
                        <input type="text" name="titre" value="">
                        <span>
                            <label for="dateFinP">Date limite: </label>
                            <input type="date" name="dateFinP" id="dateFinP" value="">
                        </span>
                    </div>

                    <textarea name="description" id="description">

                    </textarea>

                    <span>
                        <label for="porteurP">Par </label>
                        <input type="text" name="porteurP" id="porteurP" value="">
                        (<input type="text" name="email" value="">)
                        <label for="datePublic">, le </label>
                        <input type="date" name="datePublic" id="datePublic" value="">
                    </span>

                    <a href="signature.php">Signer</a>
                </div>
            </div>
        </div>
    </section>
    
</body>
</html>