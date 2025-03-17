function validateEmail() {
    let emailInput = document.getElementById("email");
    let emailError = document.getElementById("emailError");
    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!emailPattern.test(emailInput.value)) {
        emailError.style.display = "block";
        emailInput.style.border = "1px solid red";
    } else {
        emailError.style.display = "none";
        emailInput.style.border = "1px solid green";
    }
}

document.addEventListener("DOMContentLoaded", function () {

    let isEditing = false;
    let intervalPetitions, intervalMostSignedPetition;

    function fetchSignatures() {
        // Récupérer l'IDP depuis un champ caché ou un élément de la page
        let idp = document.querySelector('input[name="idp"]').value;
    
        if (!idp) {
            console.error("IDP introuvable !");
            return;
        }
    
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "/Traitement/Utilisateurs.php?fiveLastSignatures=fiveLastSignatures&idp=" + encodeURIComponent(idp), true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);
                displaySignatures(response);
            }
        };

        xhr.send();
    }
    

    function displaySignatures(signatures) {
        let container = document.querySelector(".fiveSign");
        container.innerHTML = ""; // Nettoyer la liste avant d'ajouter les nouvelles entrées

        if (signatures.length > 0) {
            signatures.forEach(signature => {
                let signDiv = document.createElement("div");
                signDiv.classList.add("signContainer");
                signDiv.innerHTML = `
                <span>${signature.Nom} ${signature.Prenom}</span> 
                <span>${signature.Pays}</span>
                <input type="number" name="ids" hidden value="${signature.IDS}">
                <div class="action">
                    <button class="edit-sign_btn" data-ids="${signature.IDS}" onclick="()=>{editSignature(${signature.IDS})}">
                        <img src="/IHM/utilisateur/static/image/edit.svg" alt="edit">
                    </button>
                    <a href="/Traitement/Utilisateurs.php?deleteSignature=deleteSignature&ids=${signature.IDS}">
                        <img src="/IHM/utilisateur/static/image/delete-button.svg" alt="edit">
                    </a>
                </div>
                `;
                container.appendChild(signDiv);

                // Ajouter les événements après l'ajout au DOM
                document.querySelectorAll(".edit-sign_btn").forEach(button => {
                    button.addEventListener("click", function () {
                        let signatureId = this.getAttribute("data-ids");
                        editSignature(signatureId);
                    });
                });
            });
        } else {
            container.innerHTML = "<p>Aucune signature pour le moment.</p>";
        }
    }

    function editSignature(ids) {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", `/Traitement/Utilisateurs.php?editSignature=editSignature&ids=${ids}`, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let signature = JSON.parse(xhr.responseText);

                console.log(signature);
                if (signature.error) {
                    console.error("Erreur:", signature.error);
                    return;
                }

                // Remplir le formulaire avec les données de la signature sélectionnée
                document.getElementById("ids").value = signature.IDS;
                document.getElementById("nom").value = signature.Nom;
                document.getElementById("prenom").value = signature.Prenom;
                document.getElementById("email").value = signature.Email;
                document.getElementById("pays").value = signature.Pays;
                document.getElementById("btn-submit").innerHTML = "Editer";
                document.getElementById("btn-submit").setAttribute("name", "sendEditSignature");

                // Faire défiler jusqu'au formulaire
                document.getElementById("signatureForm").scrollIntoView({ behavior: "smooth" });
            }
        };

        xhr.send();
    }

    fetchSignatures(); // Charger les signatures au chargement de la page

    //Rafraîchir les signatures toutes les 1 secondes
    setInterval(fetchSignatures, 2000);

    function fetchMostSignedPetition() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "/Traitement/Utilisateurs.php?mostSignedPetition=mostSignedPetition", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);
                displayMostSignedPetition(response);
            }
        };
        xhr.send();
    }

    function fetchPetitions() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "/Traitement/Utilisateurs.php?updateListPetition=updateListPetition", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let response = JSON.parse(xhr.responseText);
                displayPetitions(response);
            }
        };

        xhr.send();
    }

    function displayMostSignedPetition(petition) {
        let container = document.querySelector(".mostSignedPetition");

        if (petition && petition.Titre) {
            container.innerHTML = `
                <span style="font-size: 1.5rem;">La pétition la plus soutenue : découvrez celle qui mobilise le plus de signatures !</span> 
                <br><br><br>
                <span style="font-size: 1.7rem; color: #4A919E;">${petition.Titre}: </span>
                <span style="font-size: 1.7rem;">${petition.nbSignatures} signature(s)</span>
            `;
        } else {
            container.innerHTML = `<span>Aucune pétition disponible.</span>`;
        }
    }

    function displayPetitions(petitions) {
        let container = document.querySelector(".petitionsMainContainer");

        container.innerHTML = "";
        petitions.forEach(petition => {
            let petitionElement = document.createElement("div");
            petitionElement.classList.add("petitionContainer");

            petitionElement.innerHTML = `
                <form class="petition" action="/Traitement/Utilisateurs.php" method="post">
                    <input type="number" name="idp" hidden value="${petition.IDP}">
                    <div class="action">
                        <button type="submit" name="sendEditPetition" class="check-btn" style="display: none;">
                            <img src="/IHM/utilisateur/static/image/check.png" alt="edit">
                        </button>
                        <a class="edit-btn" onclick="updatePetition();">
                            <img src="/IHM/utilisateur/static/image/edit.svg" alt="edit">
                        </a>
                        <a href="/Traitement/Utilisateurs.php?deletePetition=deletePetition&idp=${petition.IDP}">
                            <img src="/IHM/utilisateur/static/image/delete-button.svg" alt="edit">
                        </a>
                    </div>

                    <div class="petitionHeader">
                        <input type="text" name="titre" value="${petition.Titre}" readonly>
                        <span>
                            <label for="dateFinP">Date limite: </label>
                            <input type="date" name="dateFinP" id="dateFinP" value="${petition.DateFinP}" readonly>
                        </span>
                    </div>

                    <textarea name="description" id="description" readonly>${petition.Description}</textarea>

                    <span class="info">
                        <label for="porteurP">Par </label>
                        <input type="text" name="porteurP" id="porteurP" value="${petition.PorteurP}" readonly>
                        <label>:</label>
                        <input type="text" name="email" value="${petition.Email}" readonly>
                        <label for="datePublic">, le </label>
                        <input type="date" name="datePublic" id="datePublic" value="${petition.DatePublic}" readonly>
                    </span>

                    <a href="/Traitement/Utilisateurs.php?ajoutSignature=ajoutSignature&idp=${petition.IDP}">Signer</a>
                </form>
            `;

            container.appendChild(petitionElement);

            petitionElement.querySelectorAll(".edit-btn").forEach(button => {
                button.addEventListener("click", function () {

                    clearInterval(intervalPetitions);
                    clearInterval(intervalMostSignedPetition);
                    isEditing = true;

                    // Trouver le conteneur parent de la pétition
                    let petitionContainer = this.closest(".petition");
        
                    // Afficher le bouton "check" et masquer le bouton "edit"
                    petitionContainer.querySelector(".check-btn").style.display = "inline-block";
                    this.style.display = "none";
        
                    // Rendre les champs éditables
                    petitionContainer.querySelectorAll("input, textarea").forEach(field => {
                        field.removeAttribute("readonly");
                    });
                });
            });

            petitionElement.querySelector(".check-btn").addEventListener("click", function () {
                setTimeout(() => {
                    if (!isEditing) {
                        intervalPetitions = setInterval(fetchPetitions, 2000);
                        intervalMostSignedPetition = setInterval(fetchMostSignedPetition, 2000);
                    }
                }, 2000);
                isEditing = false;
            });
        });
    }

    fetchMostSignedPetition(); // Charger la pétition au démarrage
    fetchPetitions();
    //Rafraîchir les signatures toutes les 1 secondes
    if(!isEditing){
        intervalMostSignedPetition = setInterval(fetchMostSignedPetition, 2000);
        intervalPetitions = setInterval(fetchPetitions, 2000);
    }
});

