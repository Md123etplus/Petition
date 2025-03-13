<?php
define('ROOT', str_replace('Traitement\Utilisateurs.php', '', $_SERVER['SCRIPT_FILENAME']));
require_once ROOT . 'BD\Utilisateur.php';

function loadPetitions($errors = "") {
    $petitions = getPetitions();
    include(ROOT . 'IHM\utilisateur\listePetition.php');
    // exit();
}

if (empty($_POST) && empty($_GET)) {
    include(ROOT . 'IHM\utilisateur\index.php');
    exit();
}
else if(isset($_GET['listPetition'])){

    loadPetitions();

} else if (isset($_GET['ajoutSignature'])) {
    $idp = $_GET['idp'];
    $petition = getPetitionById($idp);
    $fiveLastSignatures = getFiveLastSignatures($idp);
    if ($petition) {
        include(ROOT . 'IHM\utilisateur\ajoutSignature.php');
    }
} else if (isset($_POST['sendAjoutSignature'])) {
    $idp = $_POST['idp'];
    $titre = $_POST['titre'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pays = $_POST['pays'];
    $errors = "";
    try {
        if (existAlready($titre, $nom, $prenom, $email)) {
            $errors = "Un utilisateur avec le meme email a deja signe la petition!";
            loadPetitions($errors);
        } else {
            $signature = ajouterSignature($idp, $nom, $prenom, $pays, $email);
            if ($signature) {
                loadPetitions();
            } else {
                $errors = "Erreur d'ajout";
                loadPetitions($errors);
            }
        }
    } catch (Exception $e) {
        $errors = "Erreur: " . $e->getMessage();
        loadPetitions($errors);
    }
} else if (isset($_POST['ajoutPetition'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    // $datePublic = $_POST['datePublic'];
    $dateFinP = $_POST['dateFinP'];
    $porteurP = $_POST['porteurP'];
    $email = $_POST['email'];
    $errors = "";
    try {
        if (existAlreadyPetition($titre)) {
            $errors = "Une petition avec le meme titre existe deja!";
            loadPetitions($errors);
        } else {
            $petition = ajouterPetition($titre, $description, $dateFinP, $porteurP, $email);
            if ($petition) {
                echo $petition;
                loadPetitions();
            } else {
                $errors = "Erreur d'ajout";
                loadPetitions($errors);
            }
        }
    } catch (Exception $e) {
        $errors = "Erreur: " . $e->getMessage();
        loadPetitions($errors);
    }
} else if (isset($_GET['deletePetition'])) {
    $idp = $_GET['idp'];
    $petition = getPetitionById($idp);
    if ($petition) {
        $delete = deletePetition($idp);
        if ($delete) {
            loadPetitions();
        } else {
            $errors = "Erreur de suppression";
            loadPetitions($errors);
        }
    }
} else if (isset($_GET['deleteSignature'])) {
    $ids = $_GET['ids'];
    $signature = getSignatureById($ids);
    if ($signature) {
        $delete = deleteSignature($ids);
        if ($delete) {
            loadPetitions();
        } else {
            $errors = "Erreur de suppression";
            loadPetitions($errors);
        }
    }
} else if (isset($_GET['editPetition'])) {
    $idp = $_GET['idp'];
    $petition = getPetitionById($idp);
    if ($petition) {
        include(ROOT . 'IHM\utilisateur\editPetition.php');
    }
} else if (isset($_POST['sendEditPetition'])) {
    $idp = $_POST['idp'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $dateFinP = $_POST['dateFinP'];
    $porteurP = $_POST['porteurP'];
    $email = $_POST['email'];
    $errors = "";
    try {
        $petition = editPetition($idp, $titre, $description, $dateFinP, $porteurP, $email);
        if ($petition) {
            loadPetitions();
        } else {
            $errors = "Erreur de modification";
            loadPetitions($errors);
        }
    } catch (Exception $e) {
        $errors = "Erreur: " . $e->getMessage();
        loadPetitions($errors);
    }
} else if (isset($_GET['editSignature'])) {
    $ids = $_GET['ids'];
    $signature = getSignatureById($ids);
    if ($signature) {
        include(ROOT . 'IHM\utilisateur\editSignature.php');
    }
} else if (isset($_POST['sendEditSignature'])) {
    $ids = $_POST['ids'];
    $idp = $_POST['idp'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pays = $_POST['pays'];
    $email = $_POST['email'];
    $errors = "";
    try {
        $signature = editSignature($ids, $nom, $nom, $prenom, $pays, $email);
        if ($signature) {
            loadPetitions();
        } else {
            $errors = "Erreur de modification";
            loadPetitions($errors);
        }
    } catch (Exception $e) {
        $errors = "Erreur: " . $e->getMessage();
        loadPetitions($errors);
    }
} else {
    echo "Action non reconnue";
}