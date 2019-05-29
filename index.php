
<?php $titre = 'Connectez vous !'?>

<?php ob_start(); ?>

  <div class="container-fluid">
    <nav class="navbar navbar-light" style="background-color: #069edd;">
      <a class="text-white navbar-brand" href="">Portail de Gestion des Droits    ( <i>Répertoires INTER_SERVICE </i>)</a>
    </nav>
  </div>

  <div class=" container-fluid ">

      <div id="resultat">

        </div>
      <div class="row  " style="height: 90vh">
        <div class="col-3 m-auto ">
            <h2>Connectez-vous !</h2>
          <form action="connexion.php" method="post">
            <div class="form-group">
              <label for="login"> Code Agent </label>
              <input type="text" id="login" name="login" class="form-control" pattern="[0-9]{6}|^[\s\S]{6,}" required placeholder=""/>

            </div>
            <div class="form-group">
              <label for="mdp" >Mot de passe </label>
              <input type="password" id="mdp" name="mdp" class="form-control " required placeholder="Même mot de passe que pour les sessions" />
            </div>
            <?php if(isset($_GET['erreur'])){ ?>
              <div class="alert alert-danger" role="alert">Code agent ou mot de passe incorrect</div>
            <?php  } ?>
              <input type="submit" id="submit" name="connexion" value="Connexion" class="btn btn-primary" />
          </form>

        </div>
      </div>
  </div>

  <?php $content = ob_get_clean(); ?>
  <?php require('base.php'); ?>
</body>
</html>
