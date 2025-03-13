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
    // Sélectionne tous les boutons "edit"
    document.querySelectorAll(".edit-btn").forEach(button => {
        button.addEventListener("click", function () {
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
});

document.addEventListener("DOMContentLoaded", function () {
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
                signDiv.innerHTML = `<span>${signature.Nom} ${signature.Prenom}</span> <span>${signature.Pays}</span>`;
                container.appendChild(signDiv);
            });
        } else {
            container.innerHTML = "<p>Aucune signature pour le moment.</p>";
        }
    }

    fetchSignatures(); // Charger les signatures au chargement de la page

    //Rafraîchir les signatures toutes les 1 secondes
    setInterval(fetchSignatures, 1000);
});


document.addEventListener("DOMContentLoaded", function () {
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

    fetchMostSignedPetition(); // Charger la pétition au démarrage
    //Rafraîchir les signatures toutes les 1 secondes
    setInterval(fetchMostSignedPetition, 1000);
});
