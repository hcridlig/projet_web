<?php
session_start();
$idCand = $_SESSION['idCand'];
?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&ampdisplay=swap" rel="stylesheet"> 
    <title>Ajouter un candidat</title>
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

    <form action="../SCRIPTS/insert.php" method="POST"> 
        <table class="mod">
            <tr>
                <th>idCand</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Adresse</th>
                <th>Courriel</th>
                <th>Téléphone</th>
                <th>Spécialité</th>
                <th>Mot de passe</th>
            </tr>

            <tr>
                <td><input type="text" name="idCand" value="<?php if(isset($_GET['idCand'])){echo$_GET['idCand'];}?>"></td>
                <td><input type="text" name="nom" value="<?php if(isset($_GET['nom'])){echo$_GET['nom'];}?>"></td>
                <td><input type="text" name="prenom" value="<?php if(isset($_GET['prenom'])){echo$_GET['prenom'];}?>"></td>
                <td><input type="date" name="date" value="<?php if(isset($_GET['date'])){echo$_GET['date'];}?>"></td>
                <td><input type="text" name="adresse" value="<?php if(isset($_GET['adresse'])){echo$_GET['adresse'];}?>"></td>
                <td><input type="text" name="email" value="<?php if(isset($_GET['email'])){echo$_GET['email'];}?>"></td>
                <td><input type="number" name="telephone" value="<?php if(isset($_GET['telephone'])){echo$_GET['telephone'];}?>"></td>
                <td>
                    <select name="specialite">
                        <option value="">--Choisir une spécialité--</option>
                        <option value="100">DEV APP</option>
                        <option value="200">ING RESEAUX</option>
                        <option value="300">INTEG BDD</option>
                        <option value="400">ADM SYS</option>
                        <option value="500">Chef de projets</option>
                    </select>
                </td>
                <td><input type="text" name="password"></td>
            

    
        
                <td><input type='submit'></td>
            </tr>        
        </table>
    </form>
    <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	    <?php } ?>
</body>
</html>