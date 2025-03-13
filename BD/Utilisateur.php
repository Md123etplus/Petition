<?php
require_once 'Connexion.php';


function ajouterPetition($titre, $description, $dateFinP, $porteurP, $email) {
    $bdd = connexion(); 
    $sql = "INSERT INTO petition (Titre, Description, DatePublic, DateFinP, PorteurP, Email) 
            VALUES (:titre, :description, NOW(), :dateFinP, :porteurP, :email)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ':titre' => $titre,
        ':description' => $description,
        ':dateFinP' => $dateFinP,
        ':porteurP' => $porteurP,
        ':email' => $email
    ]);
}
function editPetition($idp, $titre, $description, $dateFinP, $porteurP, $email) {
    $bdd = connexion();
    $sql = "UPDATE petition SET Titre = :titre, Description = :description, DateFinP = :dateFinP, PorteurP = :porteurP, Email = :email WHERE IDP = :idp";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([
        ':idp' => $idp,
        ':titre' => $titre,
        ':description' => $description,
        ':dateFinP' => $dateFinP,
        ':porteurP' => $porteurP,
        ':email' => $email
    ]);
}

function existAlready($titre, $nom, $prenom, $email) {
    $bdd = connexion();
    $sql = "SELECT * FROM signature WHERE Nom = :nom AND Prenom = :prenom AND Email = :email";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function existAlreadyPetition($titre) {
    $bdd = connexion();
    $sql = "SELECT * FROM petition WHERE Titre = :titre";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':titre' => $titre]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getPetitions() {
    $bdd = connexion();
    $sql = "SELECT * FROM petition";
    return $bdd->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function getPetitionById($idp) {
    $bdd = connexion();
    $sql = "SELECT * FROM petition WHERE IDP = :idp";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':idp' => $idp]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function deletePetition($idp) {
    $bdd = connexion();
    $sql = "DELETE FROM petition WHERE IDP = :idp";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([':idp' => $idp]);
}

function ajouterSignature($idp, $nom, $prenom, $pays, $email) {
    $bdd = connexion();
    $sql = "INSERT INTO signature (IDP, Nom, Prenom, Pays, Date, Heure, Email) 
            VALUES (:idp, :nom, :prenom, :pays, NOW(), NOW(), :email)";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        ':idp' => $idp,
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':pays' => $pays,
        ':email' => $email
    ]);
}
function editSignature($ids, $nom, $prenom, $pays, $email) {
    $bdd = connexion();
    $sql = "UPDATE signature SET Nom = :nom, Prenom = :prenom, Pays = :pays, Email = :email WHERE IDS = :ids";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([
        ':ids' => $ids,
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':pays' => $pays,
        ':email' => $email
    ]);
}

function getSignatures($idp) {
    $bdd = connexion();
    $sql = "SELECT * FROM signature WHERE IDP = :idp";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':idp' => $idp]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getSignatureById($ids) {
    $bdd = connexion();
    $sql = "SELECT * FROM signature WHERE IDS = :ids";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':ids' => $ids]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function deleteSignature($ids) {
    $bdd = connexion();
    $sql = "DELETE FROM signature WHERE IDS = :ids";
    $stmt = $bdd->prepare($sql);
    return $stmt->execute([':ids' => $ids]);
}
function getFiveLastSignatures($idp) {
    $bdd = connexion();
    $sql = "SELECT * FROM signature WHERE IDP = :idp ORDER BY ID DESC LIMIT 5";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([':idp' => $idp]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>