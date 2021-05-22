<?php
session_start();
include_once('../SCRIPTS/Modele.php');
if (isset($_SESSION['idCand'])){
    $idCand = $_SESSION['idCand'];
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Notes</title>
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
        <table class="tableau">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Anglais</th>
                <th>Culture générale</th>
                <th>Français</th>
                <th>Informatique</th>
                <th>Mathématiques</th>
                <th>Physique</th>
                <th>Moyenne</th>
            </tr>


            <?php
                $cnx=Connexion("localhost", "bddtech", "root", "");
                if ($idCand==0) {
                    $req="SELECT idCand, nom, Prenoms FROM candidat WHERE idCand!=0";
                }
                else {
                    $req="SELECT idCand, nom, Prenoms FROM candidat WHERE idCand='$idCand'";
                }
                
                $candidat=requeteSelect($cnx, $req);

                foreach($candidat as $ligne){
                    $req="SELECT c.idCand, note, designation, coef FROM candidat c INNER JOIN resultat r ON c.idCand=r.idCand INNER JOIN epreuve e ON e.idEpr=r.idEpr WHERE c.idCand !=0 AND c.idCand=$ligne[0] ORDER BY designation";
                    $result=requeteSelect($cnx, $req);
                    
                    echo "<tr><td>".$ligne['nom']."</td><td>".$ligne['Prenoms']."</td>";
                    $moyenne=0;
                    $somme=0;

                    foreach($result as $value){
                        echo "<td>".$value['note']."</td>";
                        
                        $moyenne+=$value['note']*$value['coef'];
                        $somme+=$value['coef'];
                    }
                    echo "<td>".round($moyenne/$somme,2)."</td>";
                    if ($idCand==0) {
                        echo "<td><a href='Resultat_Modifier.php?idCand=$ligne[0]'>Modifier</a></td>";
                    }
                    echo "</tr>";
                    
                }
            ?>
        </table>
        <?php if (isset($_GET['succes'])){ ?>
     		<p class="succes"><?php echo $_GET['succes']; ?></p>
     	    <?php } ?>
    </section>
</body>
</html>
<?php
}else{
    header("Location: ../PAGES/index.php");
    exit();
}
?>