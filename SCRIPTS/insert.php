<?php
require_once('Modele.php');

$idCand=$_POST['idCand'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
$adresse=$_POST['adresse'];
$email=$_POST['email'];
$telephone=$_POST['telephone'];
$specialite=$_POST['specialite'];
$password=$_POST['password'];

if (empty($idCand) || empty($nom) || empty($prenom) || empty($date) || empty($adresse) || empty($email) || empty($telephone) || empty($specialite) || empty($password)) {
    header("Location: ../PAGES/Ajouter.php?error=Veuillez compléter tous les champs&idCand=$idCand&nom=$nom&prenom=$prenom&date=$date&adresse=$adresse&email=$email&telephone=$telephone&specialite=$specialite");
    exit();
}
else {
    $cnx=Connexion("localhost", "bddtech", "root", "");
    $req = "INSERT INTO candidat VALUES ($idCand, '$nom', '$prenom', '$date', '$adresse', '$email', $telephone, $specialite, '$password')";
    $result=requeteSelect($cnx, $req);

    for ($i=1; $i <=6 ; $i++) { 
        $req = "INSERT INTO resultat VALUES ($idCand, $i, 0)";
        $result=requeteSelect($cnx, $req);
    }
  
    header("Location: ../PAGES/Visu_tab_IC.php?succes=Une ligne ajoutée");
}

/*
$cnx= Connexion("localhost", "bddtech", "root", "");
$req = "UPDATE candidat SET nom='$nom', Prenoms='$prenom', Adresse='$adresse', courriel='$email', password='$password' WHERE idCand='$val'";
$result=requeteSelect($cnx, $req);*/

?>