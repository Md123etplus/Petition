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

