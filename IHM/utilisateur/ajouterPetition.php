<section class="ajoutPetition" id="ajoutP">
    <div class="container">
        <p>
            <span>"Une cause à défendre ?"</span> <br> <br>
            Lancez votre pétition et faites entendre votre voix !
        </p>
    
        <div class="formContainer">
            <form action="/Traitement/Utilisateurs.php" method="post">
                <label for="titre">Titre:</label>
                <input type="text" name="titre" id="titre" placeholder="Titre de la pétition" required>
    
                <label for="porteurP">Porteur de la pétition:</label>
                <input type="text" name="porteurP" id="porteurP" placeholder="Votre nom" required>
    
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Votre email" required oninput="validateEmail()">
                <small id="emailError" style="color: red; display: none;">Veuillez entrer une adresse email valide.</small>
    
                <label for="dateFinP">Date de fin de Publication:</label>
                <input type="date" name="dateFinP" id="dateFinP" required>
    
                <label for="description">Description:</label>
                <textarea name="description" id="description" placeholder="Entrez ici la description de cette pétition" required></textarea>

                <button type="submit" name="ajoutPetition">Envoyer</button>
            </form>
    
            <img src="/IHM/utilisateur/static/image/petition_form.jpg" alt="image pétition">
        </div>
    </div>
</section>