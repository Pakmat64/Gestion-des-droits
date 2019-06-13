<?php

  session_start(); //On récupère la session précédente

  $repertoire = $_GET['repertoire'];

  //Récupération de la liste des personnes
  $results = Shell_Exec ('C:\Windows\System32\WindowsPowerShell\v1.0\powershell.exe -executionpolicy unrestricted -command .\Scripts\liste_membres.ps1 ggss'.$repertoire);

  $liste = explode(',',$results);

  $titre = 'Liste des personnes - '.$repertoire;

  ob_start();

?>

<!-- M E N U -->
<div class="container-fluid">
  <nav class="navbar " style="background-color: #069edd;">
    <a class="text-white navbar-brand" href="">Portail de Gestion des Droits    ( <i>Répertoires INTER_SERVICE </i>)</a>
    <a class="nav-link text-white h5" href="deconnexion.php">Deconnexion</a>
  </nav>
</div>

<br>

<!-- L I S T E  D E S  P E R S O N N E S -->
<div class="container">  <!-- Vous pouvez ici remplacer la classe par container-fluid pour un tableau plus large -->
  <h1>Liste des personnes du dossier <?php echo $repertoire ?> </h1>
  <br>
  <table class="table ">
    <thead class="thead text-white " style="background-color: #069edd;">
      <tr>
        <th scope="col-5">Nom</th>
        <th scope="col-5">Code Agent</th>
        <th scope="col-2">Action</th>

      </tr>
    </thead>
    <tbody>

<!-- Affichage itératif de chaque membres -->
<?php

    foreach($liste as $cle =>$personne){
        if(isset($liste[$cle+1])){

      $personne = explode(':',$personne);

      $codeAgent = trim($personne[0]);

      $nom = trim($personne[1]);

      echo '<tr>
              <td>' .$nom.'</td>
              <td>'.$codeAgent.'</td>
              <td>
              <button type="button" id="'.$codeAgent.'" onclick="supprimer(`'.$codeAgent.'`,`'.strtr($nom,' ','_').'`)" class="btn btn-outline-danger">Supprimer</button></td>
            </tr>';
      }
    }
    echo '</tbody>
        </table>';

?>
<script>

  function supprimer(codeAgent,nom){
      var groupe = "<?php echo 'ggss'.$repertoire; ?>";
      nom = nom.replace('_',' ');
      confirmer= confirm('Etes vous sûr de vouloir supprimer '+nom+' ?')
      if(confirmer == true){
        $.post('./Appels/supp.php',{'id':codeAgent,'nom':nom, 'groupe':groupe})
        .done(function(data){
            location.reload();
        })
      }
  }
</script>

    <div class="container">
      <center>
        <a class="btn btn-outline-secondary" href="./listeRepertoires.php?codeAgent=<?php echo $_SESSION['codeAgent'] ?>">retour</a> <!-- A  C H A N G E R   ! ! !-->
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#formulaire">Ajouter une personne</button>
      </center>
    </div>
<div id="test">
</div>
  <!-- Modal -->
  <div class="modal fade" id="formulaire" >
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ajouter une personne</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body row">
          <form id="ajout" class="col" action="./Appels/ajout.php" method="post">
          <div class="form-group">

            <label for="codeAgent">Entrez son code agent</label>
            <input type="text" class="form-control" id="codeAgent" name="codeAgent"></input>
            <label class="error" for="codeAgent" id="codeAgent_erreur">Veuillez remplir ce champs</label>
          </div>

          <button  type="submit" class="btn btn-primary" >Ajouter</button>
            </form>

        </div>
      </div>
    </div>
  </div>

    <script>

    // A J O U T  M E M B R E
    $(function(){
      $('form#ajout').submit(function(e){
        e.preventDefault()
        var $formAjout = $(this)
      var repertoire = "<?php echo 'ggss'.$repertoire; ?>";
       var codeAgent = $("#codeAgent").val()
       var regex = new RegExp("[0-9]{6}")

        if(regex.test(codeAgent)){
          $.post('./Appels/ajout.php',{'rep':repertoire,'codeAgent':codeAgent})

          .done(function(data){
            $('#formulaire .close').click()
            //$('#test').html(data);
            location.reload();
          })

        .fail(function(){
            alert('OUPS ! Une erreur est survenue ...')
          })
        }
        else{
          $("label#codeAgent_erreur").html("Ce n'est pas un code Agent");
			    $("label#codeAgent_erreur").show();
			    $("input#codeAgent").focus();
        }
      })
    })
  </script>
  <?php
  $content = ob_get_clean();
  require('base.php');
  ?>
