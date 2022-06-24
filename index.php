<?php
    session_start();
    if(!isset($_SESSION['username'])){
    header("Location: login.php");
    }
    if(isset($_GET['deconnexion']))
    {
       if($_GET['deconnexion']==true)
       {
          session_unset();
          header("location:login.php");
       }
    }
    else if($_SESSION['username'] !== ""){
        $user = $_SESSION['username'];
    }
?>
<!DOCTYPE html>

<html>
    <head>
      <link rel="stylesheet" href="styles/style.css" />
      <title>Logiciel web</title>
    </head>
    <body>
      <nav class="bandeau"><table>
        <td><div class="align"><label class="entete2">Bonjour <?php echo $user ?></label></div></td>
        <td><div class="align"><a class="button" href="ouverture.php">Accès Portail</a></div></td>
        <td><div class="align droite">  <a class="buttonexit" href="index.php?deconnexion=true">Déconnexion</a></div></td></table>
      </nav>
    <div class="center">
      <div class="structure">
        <label class="entete">Gestionnaire de base de données</label>
          <button id="togg1" class="button espaceg" type="button" onClick="enregistrer()">Enregistrer</button>
          <button id="togg3" class="button" type="button" onClick="modifier()">Modifier</button>
          <button id="togg2" class="button" type="button" onClick="supprimer()">Supprimer</button>
          <table>
                  <!-- //////////////////////////////////////////////// Formulaire Enregistrer -->

                    <td class="d1" id="d1">
                      <form action="index.php" method="POST">
                        <input style="border-radius:3px; border:solid 1px; padding-top:5px;" type="text" name="nom" placeholder="Nom"><br>
                        <input style="border-radius:3px; border:solid 1px; padding-top:5px;" type="text" name="prenom" placeholder="Prénom"><br>
                        <input style="border-radius:3px; border:solid 1px; padding-top:5px;" type="text" name="carte" placeholder="Carte"><br><br>
                        <input class="valid2" type="submit" name="valider" value="Enregistrer"/>
                      </form>
                    </td>

                  <!-- //////////////////////////////////////////////// Formulaire Suupprimer -->

                    <td class="d2" id="d2">
                      <form action="index.php" method="POST">
                        <input style="border-radius:3px; border:solid 1px; padding-top:5px;" type="text" name="id" placeholder="ID"><br><br>
                        <input class="supp2" type="submit" name="delete" value="Supprimer">
                      </form>
                    </td>


                  <!-- ///////////////////////////////////////////////// Formulaire Modifier -->

                    <td class="d3" id="d3">
                      <form action="index.php" method="POST">
                        <input style="border-radius:3px; border:solid 1px; padding-top:5px;" type="text" name="id" placeholder="ID à modifier"><br>
                        <input style="border-radius:3px; border:solid 1px; padding-top:5px;" type="text" name="newnom" placeholder="Nouveau nom"><br>
                        <input style="border-radius:3px; border:solid 1px; padding-top:5px;" type="text" name="newprenom" placeholder="Nouveau prénom"><br>
                        <input style="border-radius:3px; border:solid 1px; padding-top:5px;" type="text" name="newcarte" placeholder="Carte"><br><br>
                        <input class="modif2" type="submit" name="edit" value="Modifier">
                      </form>
                    </td>
          </table>

        <hr class="test">
        <button class="submit espaceg" type="buton"><a href="index.php">Recharger la base de données</a></button>
        <div class="center">
          <?php
            try
            {
            $bdd = new PDO('mysql:host=localhost;dbname=bd_inscription', 'root', 'Password123#@!');
            }
            catch(Exception $e)
            {
            die('Erreur : '.$e->getMessage());
            }
            $reponse = $bdd->query('SELECT * FROM formulaire');
            echo "<table style='margin-left:auto; margin-right:auto; width:600px; border: solid 1px; border-radius:4px; padding-left:10px;'><tr>";
            echo "<td><p style='font-size:18px; text-align:center; color:#337ab7;'>ID<hr></p></td>";
            echo "<td><p style='font-size:18px; text-align:center; color:#337ab7;'>NOM<hr></p></td>";
            echo "<td><p style='font-size:18px; text-align:center; padding-left:10px; color:#337ab7;'>PRENOM<hr></p></td>";
            echo "<td><p style='font-size:18px; text-align:center; padding-left:10px; padding-left:10px; color:#337ab7;'>CARTE<hr></p></td>";
            //echo "<td><p style='font-size:18px; text-align:center; padding-left:10px; color:#337ab7;'>DATE</p></td></tr>";
            while($donnees=$reponse->fetch())
            {
              echo '<tr>';
              echo "<td><p style='text-align:center;'>",$donnees['id'],nl2br("</p></td>");
              echo "<td><p style='text-align:center;'>",$donnees['nom'],nl2br("</p></td>");
              echo "<td><p style='text-align:center;'>",$donnees['prenom'],nl2br("</p></td>");
              echo "<td><p style='text-align:center;'>",$donnees['carte'],nl2br("</p></td>");
              //echo "<td><p style='text-align:center;'>",$donnees['DATE'],nl2br("</p></td></tr>");
            }

            $reponse->closeCursor();
            ?>
          </div>

         <?php
            $id= $_POST['id'];
            $nom= $_POST['nom'];
            $prenom= $_POST['prenom'];
            $carte= $_POST['carte'];

            $newnom= $_POST['newnom'];
            $newprenom= $_POST['newprenom'];
            $newcarte= $_POST['newcarte'];

            $edit= $_POST['edit'];
            $delete= $_POST['delete'];
            $submitbutton= $_POST['valider'];

            if($edit) {
              try
              {
              $bdd = new PDO('mysql:host=localhost;dbname=bd_inscription', 'root', 'Password123#@!');
              }
              catch(Exception $e)
              {
              die('Erreur : '.$e->getMessage());
              }
              $bdd->exec("UPDATE `formulaire` SET nom = '$newnom', prenom = '$newprenom', carte = '$newcarte' WHERE `formulaire`.`id` = $id;");
              }

            if($delete) {
              try
              {
              $bdd = new PDO('mysql:host=localhost;dbname=bd_inscription', 'root', 'Password123#@!');
              }
              catch(Exception $e)
              {
              die('Erreur : '.$e->getMessage());
              }
              $bdd->exec("DELETE FROM `formulaire` WHERE `formulaire`.`id` = $id ");
             }

             if ($submitbutton){
              ////////////////////////////////////////////////
              if (empty($_POST['nom'])) {
                echo "<p style='text-align:center;'>Le champ nom est vide.</p>";
              }
              ////////////////////////////////////////////////
              if(empty($_POST['prenom'])) {
                echo "<p style='text-align:center;'>Le champ prénom est vide.</p>";
              }
              ////////////////////////////////////////////////
              if(empty($_POST['carte'])) {
                echo "<p style='text-align:center;'>Le champ carte est vide.</p>";
              }
              ////////////////////////////////////////////////
              try
              {
              $bdd = new PDO('mysql:host=localhost;dbname=bd_inscription', 'root', 'Password123#@!');
              }
              catch(Exception $e)
              {
              die('Erreur : '.$e->getMessage());
              }
              $bdd->exec("INSERT INTO formulaire(nom, prenom, carte) VALUES('$nom', '$prenom', '$carte')");
              echo "<p style='text-align:center;'>Enregistrement effectué !</p>";
              } // Fermeture submitbutton


              $reponse->closeCursor();
            ?>

          <br>
        </div>
      </div>
    </div>
<footer>

</footer>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
      let togg1 = document.getElementById("togg1");
      let togg2 = document.getElementById("togg2");
      let togg3 = document.getElementById("togg3");
      let d1 = document.getElementById("d1");
      let d2 = document.getElementById("d2");
      let d3 = document.getElementById("d3");

      togg1.addEventListener("click", () => {
        if(getComputedStyle(d1).display != "none"){
          d1.style.display = "none";
        } else {
          d1.style.display = "inline-table";
          d2.style.display = "none";
          d3.style.display = "none";
        }
      })
      togg2.addEventListener("click", () => {
        if(getComputedStyle(d2).display != "none"){
          d2.style.display = "none";
        } else {
          d2.style.display = "inline-table";
          d3.style.display = "none";
          d1.style.display = "none";
        }
      })
      togg3.addEventListener("click", () => {
        if(getComputedStyle(d3).display != "none"){
          d3.style.display = "none";
        } else {
          d3.style.display = "inline-table";
          d1.style.display = "none";
          d2.style.display = "none";
        }
      })
    </script>
  </body>
</html>
