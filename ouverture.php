<?php
session_start();
if(!isset($_SESSION['username'])){
header("Location: login.php");
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
        <td><div class="align"><label class="entete2">Bonjour <?php echo $user; ?></label></div></td>
        <td><div class="align"><a class="button" href="index.php">Retour</a></div></td></table>
      </nav>
    <div class="center">
      <div class="structure">
        <label class="entete">Ouverture des Portails</label>
          <button id="togg1" class="button espaceg" type="button" onClick="enregistrer()">Portail Parking</button>
          <button id="togg3" class="button" type="button" onClick="modifier()">Portail Cantine</button>
          <button id="togg2" class="button" type="button" onClick="supprimer()">Portail Cours</button>
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
