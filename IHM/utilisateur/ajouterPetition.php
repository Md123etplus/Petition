<section class="ajoutPetition">
    <div class="container">
        <p>
            <span>"Une cause à défendre ?"</span> <br> <br>
            Lancez votre pétition et faites entendre votre voix !
        </p>
    
        <div class="formContainer">
            <form action="/Petition/Traitement/Utilisateurs.php" method="post">
                <label for="titre">Titre:</label>
                <input type="text" name="titre" id="titre" placeholder="Titre de la pétition">
    
                <label for="porteurP">Porteur de la pétition:</label>
                <input type="text" name="porteurP" id="porteurP" placeholder="Votre nom">
    
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" placeholder="Votre email">
    
                <label for="dateFinP">Date de fin de Publication:</label>
                <input type="date" name="dateFinP" id="dateFinP">
    
                <label for="description">Description:</label>
                <textarea name="description" id="description" placeholder="Entrez ici la description de cette pétition"></textarea>

                <button name="ajoutPetition">Envoyer</button>
            </form>
    
            <img src="/Petition/IHM/utilisateur/static/image/petition_form.jpg" alt="image pétition">
        </div>
    </div>
</section>