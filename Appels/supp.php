<?php

  if(isset($_POST['id'])){
    $codeAgent = $_POST['id'];
    $nom = $_POST['nom'];
    $repertoire = $_POST['repertoire'];


$commande = "powershell -ExecutionPolicy unrestricted -command ../Scripts/Supp.ps1 -personne ".$codeAgent.' '.$repertoire;

Shell_Exec($commande);


  }
