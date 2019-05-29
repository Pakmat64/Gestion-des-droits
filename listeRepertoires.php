<?php

session_start();

if(isset($_SESSION['codeAgent'])){
  $codeAgent = $_SESSION['codeAgent'];
}
  $results = Shell_Exec ('C:\Windows\System32\WindowsPowerShell\v1.0\powershell.exe -executionpolicy unrestricted -command .\Scripts\listeRepertoires.ps1 \"'.$codeAgent.'\"');


$repertoires = explode(',',$results);

$titre = 'Liste des répertoires';


?>
<?php ob_start(); ?>


<!-- M E N U -->
<div class="container-fluid">
  <nav class="navbar navbar-light" style="background-color: #069edd;">
    <a class="text-white navbar-brand" href="">Portail de Gestion des Droits    ( <i>Répertoires INTER_SERVICE </i>)</a>
    <a class="nav-link text-white h5" href="deconnexion.php">Deconnexion</a>

  </nav>
</div>

<br>

<!-- L I S T E  D E S  R E P E R T O I R E -->
<div class="container">
  <h1> Liste des répertoires pour lesquels vous êtes gestionnaire  </h1>

  <br>

  <table class="table ">
    <thead class="thead text-white" style="background-color: #069edd;">
      <tr>

        <th scope="col">Nom du dossier</th>


      </tr>
    </thead>
    <tbody>
    <?php
    foreach($repertoires as $cle => $repertoire){
    if(isset($repertoires[$cle+1])){
    echo '<tr>

      <td><a href="listePersonnes.php?repertoire='.trim($repertoire).'">'.$repertoire.'</a></td>

    </tr>';
  }
}
echo '
  </tbody>
</table>

</div>';


$content = ob_get_clean();
require('base.php');

?>
