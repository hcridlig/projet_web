<?php
session_start();
include_once('../SCRIPTS/Modele.php');
if (isset($_SESSION['idCand'])){
    $idCand = $_SESSION['idCand'];
    $cnx=Connexion("localhost", "bddtech", "root", "");
    if($idCand==0){
        /*$req = "SELECT * FROM candidat ";*/
        $req="SELECT idCand, nom, Prenoms, DateNaissance, Adresse, courriel, Telephone, specialite FROM candidat c INNER JOIN specialite s ON c.idSpec=s.idSpec WHERE idCand !=0 ORDER BY idCand";
        $result=requeteSelect($cnx, $req);
    }
    else{
        $req = "SELECT * FROM candidat c INNER JOIN specialite s ON c.idSpec=s.idSpec WHERE c.idCand='$idCand'"; 
        $result=requeteSelect($cnx, $req);
    }
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Infos Candidats</title>
    <link rel="stylesheet" href="../CSS/style_visu3.css">
    <link rel="icon" href="../favicon.png ">
</head>
<body>
    <header>
        <nav>
            <?php if($idCand==0){?>
            <div class="dropdown">
                <button class="dropbtn">Candidat
                <i class="arrow down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="Visu_tab_IC.php">Liste des Candidats</a>
                    <a href="Ajouter.php">Ajouter un candidat</a>
                    <a href="Supprimer.php">Supprimer un candidat</a>
                </div>
            </div> 
            <?php
            }
            else{
                ?><a href="Visu_tab_IC.php">Informations</a><?php
            }?>
  
            <a href="Visu_tab_R.php">Résultat</a>
            <a href="../SCRIPTS/Logout.php">Deconnexion</a>
        </nav>
    </header>
    <section>
    <?php if (isset($_GET['succes'])){ ?>
     		<p class="succes"><?php echo $_GET['succes']; ?></p>
     	    <?php } ?>
             
        <table class="tableau">
            <tr>
                <th>IdCand</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Adresse mail</th>
                <th>Téléphone</th>
                <th>Specialité</th>
            </tr>

            <?php
            foreach($result as $ligne){
                echo "<tr>"."<td>".$ligne['idCand']."</td>"."<td>".$ligne['nom']."</td>"."<td>".$ligne['Prenoms']."</td>"."<td>".$ligne['DateNaissance']."</td>"."<td>".$ligne['Adresse']."</td>"."<td>".$ligne['courriel']."</td>"."<td>"."0".$ligne['Telephone']."</td>"."<td>".$ligne['specialite']."</td>"."<td>"."<a href='../PAGES/Modifier.php?val=$ligne[0]'>Modifier</a>"."</td>"."</tr>";
                echo "\n";
            }
            ?>
    
        </table>       
    </section>
</body>
</html>

<?php
}else{
    header("Location: ../PAGES/index.php");
    exit();
}

?>