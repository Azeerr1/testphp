<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" href="styles/style.css" media="screen" type="text/css" />
    </head>
    <body>
      <nav class="bandeau">
        <label class="entete2">Bienvenue</label>
      </nav>
    <div class="center">
      <div class="structure">

            <label class="entete">Gestionnaire de base de données</label>
            <br>
            <hr class="test">
            <div class="center">
              <form action="verification.php" method="POST">
                <label>Nom</label><br>
                <input class="input" type="text" name="username" placeholder="Nom"><br><br>
                <label>Mot de passe</label><br>
                <input class="input" type="password" name="password" placeholder="Mot de passe"><br><br>
                <input class="button"  type="submit" id='submit' value="Se connecter"/>
              </form>
            </div>

                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
        </div>
    </body>
</html>
